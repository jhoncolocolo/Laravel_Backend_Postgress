<?php

namespace App\Services\Role;
use Illuminate\Support\Facades\Facade;


class RoleFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'Role';
    }
}