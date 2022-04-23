<?php

namespace App\Services\General;

use Illuminate\Support\Facades\Facade;

class GeneralFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "General";
    }
}
