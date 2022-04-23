<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $json = File::get("database/data/users.json");
            $data = json_decode($json);
            foreach ($data as $obj) {
                User::create([
                    "id"=> $obj->id,
                    "name"=> $obj->name,
                    "email"=> $obj->email,
                    "email_verified_at"=> $obj->email_verified_at,
                    "password"=> $obj->password
                ]);
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
        }
    }
}