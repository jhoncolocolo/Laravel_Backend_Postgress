<?php

namespace Tests\Factory;

use Illuminate\Support\Facades\File;
use App\Models\PermissionRole;

class TablesDependentFactory
{

    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public static function createTables($table_create_data): TablesDependentFactory
    {
        try {

           $table = $table_create_data;
           $tables = ["permission_roles"];
            if (in_array($table_create_data, $tables))
            {
                foreach ($tables as $curren_table) {
                    if($curren_table == $table_create_data){
                        // package_years
                         if($table == "permission_roles"){
                            $json = File::get("database/data/permission_roles.json");
                            $data = json_decode($json);
                            foreach ($data as $obj) {
                                PermissionRole::create([
                                    "role_id" => $obj->role_id,
                                    "permission_id" => $obj->permission_id,
                                ]);
                            }
                        }
                    }
                }
            }
            else
            {
                return false;
            }

        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            echo $e;
        }

        return new TablesDependentFactory($table);
    }
}