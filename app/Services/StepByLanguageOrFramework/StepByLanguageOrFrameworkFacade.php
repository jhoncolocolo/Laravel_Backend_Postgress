<?php

namespace App\Services\StepByLanguageOrFramework;
use Illuminate\Support\Facades\Facade;


class StepByLanguageOrFrameworkFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'StepByLanguageOrFramework';
    }
}