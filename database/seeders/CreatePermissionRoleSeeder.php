<?php
namespace Database\Seeders;
use App\Models\PermissionRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreatePermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $json = File::get("database/data/permission_roles.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                PermissionRole::create([
                    "role_id" => $obj->role_id,
                    "permission_id" => $obj->permission_id,
                ]);
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        }
    }
}