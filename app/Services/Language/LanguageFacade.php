<?php

namespace App\Services\Language;
use Illuminate\Support\Facades\Facade;


class LanguageFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'Language';
    }
}