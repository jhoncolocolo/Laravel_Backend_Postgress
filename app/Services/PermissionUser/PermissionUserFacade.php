<?php

namespace App\Services\PermissionUser;
use Illuminate\Support\Facades\Facade;


class PermissionUserFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'PermissionUser';
    }
}