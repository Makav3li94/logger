<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\FetchLogs;
use App\Http\Controllers\Interfaces\ManageFilters;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public $data;

    public function __construct(Request $request)
    {
        $this->data = $request->all();
    }

    public function index()
    {
        //Manage filters
        $conditions = (new Interfaces\ManageFilters)->getConditions($this->data);

        //Fetch logs
        $logs = (new Interfaces\FetchLogs)->fetchData($conditions);

        return response(['count' => count($logs)], 200);
    }


}
