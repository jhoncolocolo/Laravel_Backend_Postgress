<?php
namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $json = File::get("database/data/permissions.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Permission::create([
                    "id"=> $obj->id,
                    "name"=> $obj->name,
                    "route"=> $obj->route,
                    "path"=> $obj->path,
                    "description"=> $obj->description
                ]);
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        }
    }
}