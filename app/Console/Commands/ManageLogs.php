<?php

namespace App\Console\Commands;

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
            $handle = fopen(public_path('logs/logs.txt'), 'r');

            while (($line = fgets($handle)) !== false) {
                yield $line;
            }
        })->chunk(5)->each(function ($lines) {
            $data = [];
            foreach ($lines as $line) {
                if (isset($line[1])) {
                    $service = explode('-', $line);
                    $info = explode(' ', $service[2]);

                    $logDate = trim($info[1], '[]');
                    $logDate = preg_replace("/:/", " ", $logDate, 1);
                    $logDate = str_replace("/", "-", $logDate);
                    $logDate = date('Y-m-d H:i:s', strtotime($logDate));
                    $serviceName = $service[0];
                    $requestType = trim($info[2], '"');
                    $requestRoute = trim($info[3], '/');
                    $requestHeader = trim($info[4], '"');
                    $responseType = str_replace("\n", "", $info[5]);

                    $data[] = [
                        'log_date' => $logDate,
                        'service_name' => $serviceName,
                        'request_type' => $requestType,
                        'request_route' => $requestRoute,
                        'request_header' => $requestHeader,
                        'response_type' => $responseType,
                    ];
                }
            }

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
