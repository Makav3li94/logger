<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $cons = [];
        if (isset($request->serviceNames)) $cons[] = ['service_name', $request->serviceNames];
        if (isset($request->statusCode)) $cons[] = ['response_type', $request->statusCode];
        if (isset($request->startDate)) $cons[] = ['log_date', '>=', $request->startDate];
        if (isset($request->endDate)) $cons[] = ['log_date', '<=', $request->endDate];
        if (count($cons) > 1) {
            $logs = Log::where($cons)->get();
        } else {
            $logs = Log::all();
        }
        return response(['count'=>count($logs)]);
    }
}
