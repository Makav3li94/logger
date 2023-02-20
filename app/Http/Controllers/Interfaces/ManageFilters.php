<?php

namespace App\Http\Controllers\Interfaces;

class ManageFilters implements LogControllerFilterInterface
{
    public function getConditions(array $data): array
    {
        $conditions = [];
        if (isset($data['serviceNames'])) $conditions[] = ['service_name', $data['serviceNames']];
        if (isset($data['statusCode'])) $conditions[] = ['response_type', $data['statusCode']];
        if (isset($data['startDate'])) $conditions[] = ['log_date', '>=', $data['startDate']];
        if (isset($data['endDate'])) $conditions[] = ['log_date', '<=', $data['endDate']];
        return $conditions;
    }
}
