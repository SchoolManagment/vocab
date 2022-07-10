<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:update';

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
        $this->info('Start Database update!');
        $this->warn('PLEASE DO NOT STOP THE SCRIPT UNTIL IT HAS FINISHED!');
        $this->info('Backup data ...');

        $data = [
            "asks"     => DB::table('asks')->all()->toArray(),
            "books"    => DB::table('books')->all()->toArray(),
            "chapters" => DB::table('chapters')->all()->toArray(),
            "scores"   => DB::table('scores')->all()->toArray(),
            "users"    => DB::table('users')->all()->toArray(),
            "words"    => DB::table('words')->all()->toArray(),
        ];

        $this->call('migrate:fresh');

        $bar = $this->output->createProgressBar(count($data));
        $bar->start();

        foreach ($data as $table => $values) {
            DB::table($table)->updateOrInsert($values);
            $bar->advance();
        }

        $bar->finish();

        $this->info('OK');

        return 0;
    }
}
