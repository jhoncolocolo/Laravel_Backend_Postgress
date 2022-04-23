<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CreateUserSeeder::class);
        $this->call(CreateRoleSeeder::class);
        $this->call(CreatePermissionSeeder::class);
        $this->call(CreatePermissionRoleSeeder::class);
        $this->call(CreateRoleUserSeeder::class);
        $this->call(CreateLanguageSeeder::class);
    }
}
