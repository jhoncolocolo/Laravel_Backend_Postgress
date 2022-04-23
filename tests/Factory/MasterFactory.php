<?php

namespace Tests\Factory;

use App\Models\Permission;
use App\Models\Role;

use Illuminate\Support\Facades\File;

class MasterFactory
{

    public function __construct()
    {
    }

    public static function createBase(): MasterFactory
    {
        try {

            //Permissions
            //dd(json_decode(File::get("database/data/permissions.json")));
            foreach (json_decode(File::get("database/data/permissions.json")) as $permission) {
                Permission::create([
                    "id"=> $permission->id,
                    "name"=> $permission->name,
                    "route"=> $permission->route,
                    "path"=> $permission->path,
                    "description"=> $permission->description
                ]);
            }

            //Roles
            foreach (json_decode(File::get("database/data/roles.json")) as $role) {
                Role::create([
                    "id"=> $role->id,
                    "name"=> $role->name,
                    "description"=> $role->description
                ]);
            }

        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            echo $e;
        }

        return new MasterFactory();
    }
}