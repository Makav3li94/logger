<?php

namespace App\Console\Commands;

use App\Console\Commands\Interfaces\ParseLogsData;
use App\Models\Log;
use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;

class ManageLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses the log file and save them in db';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        LazyCollection::make(function () {
            //Open File as single lines
            $handle = fopen(public_path('logs/logs.txt'), 'r');

            while (($line = fgets($handle)) !== false) {
                yield $line;
            }
        })->chunk(env('CHUNK_SIZE'))->each(function ($lines) {
            //Parse and modify data to right format
            $data = [];
            foreach ($lines as $line) {
                if (isset($line[1])) {
                    $data = (new ParseLogsData)->parseLogs($line, $data);
                }
            }

            //Save to database
            $log = Log::upsert($data, ['log_date'], ['service_name'], ['response_type']);
            if ($log) {
                $this->info("{$log} Logs Added !");
            } else {
                $this->info("Log Duplicate,Not added!");

            }
        });
        $this->info("Operation Success !");

    }
}


