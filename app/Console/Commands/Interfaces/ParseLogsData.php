<?php

namespace App\Console\Commands\Interfaces;

class ParseLogsData implements ManageLogsInterface
{
    public function parseLogs(mixed $line, array $data): array
    {
        //Explodes !
        $service = explode('-', $line);
        $info = explode(' ', $service[2]);

        //Date Modify !
        $logDate = trim($info[1], '[]');
        $logDate = preg_replace("/:/", " ", $logDate, 1);
        $logDate = str_replace("/", "-", $logDate);
        $logDate = date('Y-m-d H:i:s', strtotime($logDate));

        //Other Data Modify !
        $serviceName = $service[0];
        $requestType = trim($info[2], '"');
        $requestRoute = trim($info[3], '/');
        $requestHeader = trim($info[4], '"');
        $responseType = str_replace("\n", "", $info[5]);

        //Store to array !
        $data[] = [
            'log_date' => $logDate,
            'service_name' => $serviceName,
            'request_type' => $requestType,
            'request_route' => $requestRoute,
            'request_header' => $requestHeader,
            'response_type' => $responseType,
        ];
        return $data;
    }
}

