<?php

namespace App\Services;

class BaseService
{

    public function ifNotExists($model): bool
    {
       return empty($model);
    }
}
