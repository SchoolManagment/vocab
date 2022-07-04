<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Score;
use App\Models\Section;
use App\Models\Word;
use Livewire\Component;

class WordForm extends Component
{
    public $word;
    public $other_words = [];
    public $translations = [];

    public $model = null;
    public $section;
    public $book;

    public $edit;

    public $heading = "Wort hinzufügen";
    public $message = null;

    protected $rules = [
        'word' => 'required|string',
        'other_words' => 'nullable|array',
        'translations' => 'nullable|array',
    ];

    public function mount(Book $book, Section $section, Word $word = null, bool $edit = false){
        $this->word = request()->word;
        $this->other_words = json_decode(request()->other_words) ?? [];
        $this->translations = json_decode(request()->translations) ?? [];

        if ($this->edit = $edit) {
            $this->initModel($word);
        }

        $this->book = $book;
        $this->section = $section;
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    private function initModel($word){
        $this->model = $word;
        $this->word = $this->model->word;
        $this->other_words = $this->model->other_words;
        $this->translations = $this->model->translations;

        $this->heading = "Wort {$word->word} bearbeiten";
    }

    public function addOption(string $val){
        $this->{$val}[] = '';
    }

    public function removeOption(string $val, $key){
        unset($this->{$val}[$key]);
    }

    public function saver(){
        if ($this->edit) {
            $this->model->update($this->validate());
        } else {
            $this->model = Word::create(array_merge($this->validate(), [
                'section_id' => $this->section->id,
                'book_id' => $this->book->id,
                'user_id' => auth()->id(),
            ]));

            Score::create([
                'word_id' => $this->model->id,
                'section_id' => $this->section->id,
                'book_id' => $this->book->id,
                'user_id' => auth()->id(),
                'score' => 1
            ]);
        }
    }

    public function save(){
        $this->saver();

        if ($this->edit) {
            return redirect()->route('book.section.word.show', [
                'book' => $this->book,
                'section' => $this->section,
                'word' => $this->model,
            ])->with('success', "Wort {$this->model->word} aktualisiert.");
        }

        return redirect()->route('book.section.word.show', [
            'book' => $this->book,
            'section' => $this->section,
            'word' => $this->model,
        ])->with('success', "Wort {$this->model->word} erstellt");
    }

    public function saveSite(){
        $this->saver();

        $this->emit('msg.success', "Wort {$this->model->word} erstellt");
        $this->reset('word', 'other_words', 'translations', 'model');
    }

    public function render()
    {
        return view('livewire.word-form');
    }
}
