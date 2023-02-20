<?php

namespace App\Console\Commands\Interfaces;

interface ManageLogsInterface
{
    public function parseLogs(mixed $line, array $data);
}
