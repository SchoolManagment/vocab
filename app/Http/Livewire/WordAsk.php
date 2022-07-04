<?php

namespace App\Http\Livewire;

use App\Models\{
    Ask,
    Book,
    Score,
    Section,
    Word
};
use Livewire\Component;

class WordAsk extends Component
{
    public $words_to_ask = 10;

    public $book;
    public $section;
    public $words;

    public $now = [];
    public $before = [];

    public bool $check = false;
    public int $step = 1;
    public $view = 'ask';

    public $word;
    public $translations = [];

    public array $results;

    protected $queryString = [
        'step' => ['except' => '', 'as' => 'word'],
    ];

    public function mount(Book $book){
        $this->book = $book;
        $this->section = (request()->has('section')) ? Section::find(request()->get('section')) : null;

        $this->init();
        $this->loadStep(1);
    }

    private function init(){
        $scores = Score::where('book_id', $this->book->id)->inRandomOrder()->orderBy('score')->limit($this->words_to_ask)->pluck('word_id');
        $words = Word::whereIn('id', $scores)->limit($this->words_to_ask)->get();

        if (count($words) == 0) {
            $words = Word::where('book_id', $this->book->id)->limit($this->words_to_ask)->inRandomOrder()->get();
        }

        $old_words = $words;
        $words = [];
        $count = 0;

        foreach ($old_words as $word) {
            $count++;
            $words[$count] = [
                'id' => $word->id,
                'word' => $word->word,
                'score' => $word->score->score,
            ];
        }

        $this->now = compact('words');
        $this->words = $words;
        $this->words_to_ask = count($this->words);
    }

    public function loadStep(int $step){
        $this->reset('translations');

        $this->word = Word::find($this->words[$step]['id']);
        foreach ($this->word->translations ?? [] as $value) {
            $this->translations[$value] = "";
        }
        $this->step = $step;

        // dd($this->word);
    }

    public function nextStep(){
        $nextStep = $this->step + 1;

        if ($nextStep > $this->words_to_ask || !isset($this->words[$nextStep])) {
            $this->result();
            $this->view = 'results';
            return;
        }

        return $this->loadStep($nextStep);
    }

    public function demo(){
        $this->emit('msg.success', "Deine Antwort war richtig.");
        $this->nextStep();
    }

    public function check(){
        // dd($this->words);
        $check = true;
        foreach($this->translations as $key => $value){
            if ($key != $value) {
                $check = false;
                break;
            }
        }

        if ($check) {
            $this->checkOk();
        } else {
            $this->view = "check";
            $this->emit('msg.info', "Deine Antwort stimmt nicht mit den gespeicherten Übersetzungen überein. Überpüfe sie bitte.");
        }
    }

    public function checkOK(){
        $this->view = 'ask';
        $this->word->score->addPoint();
        $this->emit('msg.success', "Deine Antwort war richtig.");
        $this->nextStep();
    }

    public function checkFail(){
        $this->view = 'ask';
        $this->word->score->setPoint();
        $this->emit('msg.fail', "Deine Antwort war falsch.");
        $this->nextStep();
    }

    public function nextWord(){
        $this->view = 'ask';
        $this->word->score->removePoint();
        $this->emit('msg.info', "Du hast dieses Wort übersprungen.");
        $this->nextStep();
    }

    public function result(){
        foreach($this->words as $step => $value){
            $this->results[$step] = array_merge($value, [
                'new_score' => Word::find($value['id'])->score->score,
            ]);
        }

        Ask::create([
            'book_id' => $this->book->id,
            'user_id' => auth()->id(),
            'words' => $this->results,
            'day' => now(),
        ]);
    }

    public function render()
    {
        return view('livewire.word-ask');
    }
}
