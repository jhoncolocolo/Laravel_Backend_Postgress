<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $json = File::get("database/data/roles.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                Role::create([
                    "id"=> $obj->id,
                    "name"=> $obj->name,
                    "description"=> $obj->description
                ]);
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        }
    }
}