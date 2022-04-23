<?php

namespace Database\Seeders;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreateRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $json = File::get("database/data/role_by_users.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                RoleUser::create([
                    "role_id"=> $obj->role_id,
                    "user_id"=> $obj->user_id
                ]);
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        }
    }
}