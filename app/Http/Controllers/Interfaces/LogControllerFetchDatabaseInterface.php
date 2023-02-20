<?php

namespace App\Http\Controllers\Interfaces;

interface LogControllerFetchDatabaseInterface
{
    public function fetchData(array $conditions);
}
