<?php

namespace App\Http\Controllers\Interfaces;

use App\Models\Log;

class FetchLogs implements LogControllerFetchDatabaseInterface
{
    public function fetchData(array $conditions): array
    {
        return  Log::where($conditions)->get()->toArray();
    }
}
