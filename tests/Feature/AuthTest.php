<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Tests\Factory\MasterFactory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\PermissionRole;
use App\Models\RoleUser;
use Tests\Factory\TablesDependentFactory;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        //Base Factories
        MasterFactory::createBase();
        TablesDependentFactory::createTables("permission_roles");
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->json('POST', '/api/register', [
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'test@example.com',
            'password'  =>  $password = '123456789',
        ]);

        //Write the response in laravel.log
        $response->assertJson(
            [
                "name"=> $name,
                "email"=> $email
            ]
        );

        $response->assertStatus(201);
        // Delete users
        User::where('email',$email)->delete();
    }


    public function testLogin()
    {
        // Creating Users
        User::create([
            'name' => 'Test',
            'email'=> $email = time().'@example.com',
            'password' => bcrypt('123456789')
        ]);

        // Simulated landing
        $response = $this->json('POST','/api/login',[
            'email' => $email,
            'password' => '123456789',
        ]);

        $response->assertStatus(200);

        //If Get Access Token
        $this->assertArrayHasKey('message',$response->json());

        // Delete users
        User::where('email',$email)->delete();
    }

    public function testLogout(){
        // Creating Users
        User::create([
            'name' => 'Test',
            'email'=> $email = time().'@example.com',
            'password' => bcrypt('123456789')
        ]);

        // Simulated landing
        $login = $this->json('POST','/api/login',[
            'email' => $email,
            'password' => '123456789',
        ]);

        $token = $login->json()["message"];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST','api/logout');

        $response->assertJson([
            'message' => "Success"
        ]);

        $response->assertStatus(200);
        User::where('email',$email)->delete();
    }

    public function testMeWithOutPermissions(){
        // Creating Users
        User::create([
            'name' => 'Test',
            'email'=> $email = time().'@example.com',
            'password' => bcrypt('123456789')
        ]);

        // Simulated landing
        $login = $this->json('POST','/api/login',[
            'email' => $email,
            'password' => '123456789',
        ]);

        $token = $login->json()["message"];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/user');

        $response->assertJson([
            "name" => 'Test',
            "role" => null,
            "email" => $email,
            "permissions" => []
        ]);

        $response->assertStatus(200);
        User::where('email',$email)->delete();
    }

    public function testMeWithPermissionsCRUD(){
        // Creating Users
        $user = User::create([
            'name' => 'Test',
            'email'=> $email = time().'@example.com',
            'password' => bcrypt('123456789')
        ]);

        RoleUser::create(["role_id" => Role::where("name","CRUD Role")->first()->id,"user_id" => $user->id]);

        // Simulated landing
        $login = $this->json('POST','/api/login',[
            'email' => $email,
            'password' => '123456789',
        ]);

        $token = $login->json()["message"];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/user');


        $response->assertJson([
            "name" => 'Test',
            "role" => null,
            "email" => $email,
            "permissions" =>  [
                [
                  "role" => "CRUD Role",
                  "route" => "languages.index",
                  "path" => "/languages",
                  "description" => "See Languages List Information"
                ],
                [
                  "role" => "CRUD Role",
                  "route" => "languages.store",
                  "path" => null,
                  "description" => "Access To Form to store New Language"
                ],
                [
                  "role" => "CRUD Role",
                  "route" => "languages.update",
                  "path" => null,
                  "description" => "Access To Update One Exists Language"
                ],
                [
                  "role" => "CRUD Role",
                  "route" => "languages.destroy",
                  "path" => null,
                  "description" => "Allow Delete Languages of system"
                ],
                [
                  "role" => "CRUD Role",
                  "route" => "languages.show",
                  "path" => null,
                  "description" => "See Language By Parameter"
                ],
                [
                  "role" => "CRUD Role",
                  "route" => "languages.create",
                  "path" => "/languages/create",
                  "description" => "Show Form Languages"
                ],
                [
                  "role" => "CRUD Role",
                  "route" => "languages.edit",
                  "path" => "/languages/edit",
                  "description" => "Show Form Languages"
                ]
              ]
        ]);

        $response->assertStatus(200);
        User::where('email',$email)->delete();
    }
}
