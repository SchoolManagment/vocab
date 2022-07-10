<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Score;
use App\Models\Chapter;
use App\Models\Word;
use Livewire\Component;

class WordForm extends Component
{
    public $word;
    public $other_words = [];
    public $translations = [];

    public $model = null;
    public $chapter;
    public $book;

    public $edit;

    public $heading = "Wort hinzufügen";
    public $message = null;

    protected $rules = [
        'word' => 'required|string',
        'other_words' => 'nullable|array',
        'translations.*' => 'required|string',
    ];

    public function mount(Book $book, Chapter $chapter, Word $word = null, bool $edit = false){
        $this->word = request()->word;
        $this->other_words = json_decode(request()->other_words) ?? [];
        $this->translations = json_decode(request()->translations) ?? [];

        if ($this->edit = $edit) {
            $this->initModel($word);
        }

        $this->book = $book;
        $this->chapter = $chapter;
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
        foreach($this->translations as $key => $value){
            $this->translations[$key] = urlencode($value);
        }

        if ($this->edit) {
            $this->model->update($this->validate());
        } else {
            $this->model = Word::create(array_merge($this->validate(), [
                'chapter_id' => $this->chapter->id,
                'book_id' => $this->book->id,
                'user_id' => auth()->id(),
            ]));

            Score::create([
                'word_id' => $this->model->id,
                'chapter_id' => $this->chapter->id,
                'book_id' => $this->book->id,
                'user_id' => auth()->id(),
                'score' => 1
            ]);
        }
    }

    public function save(){
        $this->saver();

        if ($this->edit) {
            return redirect()->route('book.chapter.word.show', [
                'book' => $this->book,
                'chapter' => $this->chapter,
                'word' => $this->model,
            ])->with('success', "Wort {$this->model->word} aktualisiert.");
        }

        return redirect()->route('book.chapter.word.show', [
            'book' => $this->book,
            'chapter' => $this->chapter,
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
