<?php

namespace App\Services\RoleUser;
use Illuminate\Support\Facades\Facade;


class RoleUserFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'RoleUser';
    }
}