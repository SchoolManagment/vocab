<?php

namespace App\Console\Commands;

use App\Models\Word;
use Illuminate\Console\Command;

class ReformWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:words-reform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Starting');

        $this->withProgressBar(Word::all(), function($word){
            $other_words = $translations = [];
            foreach($word->other_words as $key => $value){
                $value = urldecode($value);
                $other_words[$key] = urlencode($value);
            }
            foreach($word->translations as $key => $value){
                $value = urldecode($value);
                $translations[$key] = urlencode($value);
            }

            $word->update([
                'other_words' => $other_words,
                'translations' => $translations,
            ]);
        });

        $this->newLine();
        $this->info('All Words reformed');

        return 0;
    }
}
