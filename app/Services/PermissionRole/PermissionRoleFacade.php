<?php

namespace App\Services\PermissionRole;
use Illuminate\Support\Facades\Facade;


class PermissionRoleFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'PermissionRole';
    }
}