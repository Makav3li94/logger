<?php

namespace App\Http\Controllers\Interfaces;

interface LogControllerFilterInterface
{
    public function getConditions(array $data);
}
