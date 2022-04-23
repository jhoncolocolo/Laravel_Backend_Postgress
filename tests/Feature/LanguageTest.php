<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Language;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\RoleUser;

class LanguageTest extends TestCase
{
    use RefreshDatabase;
    protected $roleAdmin;
    protected $role_crud;
    protected function setUp(): void
    {
        parent::setUp();
        //Base Factories
        $this->roleAdmin = Role::create(["id" => 1,"name" => "Admin","role" => "admin","description" => "System Administrator"]);
        $this->role_crud = Role::create(["id" => 2,"name" => "CRUD Role","role" => null,"description" => "Role that can Select, Save, Update and Delete Information"]);
        $this->role_cru = Role::create(["id" => 3,"name" => "CRU Role","role" => null,"description" => "Role that can Select, Save, and Update Information  but no delete it"]);

        $permission_index = Permission::create(["name" => "Languages List","route" =>"languages.index","path" => "/languages","description" => "See Languages List Information"]);
        $permission_show = Permission::create(["name" => "Show Language By Parameter","route" =>"languages.show","path" => null,"description" => "See Language By Parameter"]);
        $permission_store = Permission::create(["name" => "Language's Store","route" =>"languages.store","path" => null,"description" => "Access To Form to store New Language"]);
        $permission_update = Permission::create(["name" => "Language's Update","route" =>"languages.update","path" => null,"description" => "Access To Update One Exists Language"]);
        $permission_delete  = Permission::create(["name" => "Language's Delete","route" =>"languages.destroy","path" => null,"description" => "Allow Delete Languages of system"]);

        //Permissions To CRUD User
        PermissionRole::create(["role_id" => $this->role_crud->id,"permission_id" => $permission_index->id]);
        PermissionRole::create(["role_id" => $this->role_crud->id,"permission_id" => $permission_show->id]);
        PermissionRole::create(["role_id" => $this->role_crud->id,"permission_id" => $permission_store->id]);
        PermissionRole::create(["role_id" => $this->role_crud->id,"permission_id" => $permission_update->id]);
        PermissionRole::create(["role_id" => $this->role_crud->id,"permission_id" => $permission_delete->id]);

        //Permissions To CRU User
        PermissionRole::create(["role_id" => $this->role_cru->id,"permission_id" => $permission_index->id]);
        PermissionRole::create(["role_id" => $this->role_cru->id,"permission_id" => $permission_show->id]);
        PermissionRole::create(["role_id" => $this->role_cru->id,"permission_id" => $permission_store->id]);
        PermissionRole::create(["role_id" => $this->role_cru->id,"permission_id" => $permission_update->id]);
    }

    /**
     * Authenticate user.
     *
     * @return void
     */
    protected function authenticate($role=null)
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345,678910).'test@gmail.com',
            'password' => \Hash::make('secret9874'),
        ]);

        switch ($role) {
            case 'cru':
                //dd("mne meti a cru");
                    RoleUser::create(["role_id" => $this->role_cru->id,"user_id" => $user->id]);
                break;
            case 'crud':
                //dd("mne meti a crud");
                    RoleUser::create(["role_id" => $this->role_crud->id,"user_id" => $user->id]);
                break;
            default:
                    //dd("mne meti a admin");
                    RoleUser::create(["role_id" => $this->roleAdmin->id,"user_id" => $user->id]);
                break;
        }

        if (!auth()->attempt(['email'=>$user->email, 'password'=>'secret9874'])) {
            return response(['message' => 'Login credentials are invaild']);
        }

        return $accessToken = auth()->user()->createToken('token')->plainTextToken;
    }


     /**
    * test get all products.
    *
    * @return void
    */
   public function test_languages_get_all_admin()
   {
       $token = $this->authenticate();
       $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
       $language = Language::create(["name_en" => "Second Edition","name_es" => "Segunda Edición","meaning_name_en" => "This is the Second time in one edition.","meaning_name_es" => "Esta es la Segunda edición."]);
       $response = $this->withHeaders([
           'Authorization' => 'Bearer '. $token,
       ])->json('GET','api/languages');

       $response->assertJson([
            [
                "name_en" => "First Edition",
                "name_es" => "Primera Edición",
                "meaning_name_en" => "This is the first time in one edition.",
                "meaning_name_es" => "Esta es la primera edición."
            ],
            [
                "name_en" => "Second Edition",
                "name_es" => "Segunda Edición",
                "meaning_name_en" => "This is the Second time in one edition.",
                "meaning_name_es" => "Esta es la Segunda edición."
            ]
        ]);

        $this->assertDatabaseCount('languages', 2);

        $this->assertDatabaseHas('languages', [
            'id' => 2
        ]);

       $response->assertStatus(200);
   }

    /**
     * test find Languages Admin.
     *
     * @return void
     */
    public function test_languages_find_admin()
    {
        $token = $this->authenticate();
        $language = Language::create(["name_en" => "Third Edition","name_es" => "Tercera Edición","meaning_name_en" => "This is the Third time in one edition.","meaning_name_es" => "Esta es la tercera edición."]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/languages/'.$language->id);

        $this->assertDatabaseHas('languages', [
            "name_es" => "Tercera Edición"
        ]);
        $response->assertStatus(200);
    }

    /**
     * test create languages admin.
     *
     * @return void
     */
    public function test_languages_create_admin()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST','api/languages',[
            "name_en" => "First Edition",
            "name_es" => "Primera Edición",
            "meaning_name_en" => "This is the first time in one edition.",
            "meaning_name_es" => "Esta es la primera edición."
        ]);
        $this->assertDatabaseCount('languages', 1);
        $response->assertStatus(200);
    }

    /**
     * test update languages admin.
     *
     * @return void
     */
    public function test_languages_update_admin()
    {
        $token = $this->authenticate();
        $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT','api/languages/'.$language->id,[
            "name_en" => "First Edition Update",
            "name_es" => "Primera Edición Actualizada",
            "meaning_name_en" => "This is the first time in one edition Updated.",
            "meaning_name_es" => "Esta es la primera edición Actualizada."
        ]);

        $this->assertDatabaseHas('languages', [
            "name_en" => "First Edition Update",
            "meaning_name_en" => "This is the first time in one edition Updated."
        ]);

        $response->assertStatus(200);
    }

    /**
     * test delete languages admin.
     *
     * @return void
     */
    public function test_languages_delete_admin()
    {
        $token = $this->authenticate();
        $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE','api/languages/'.$language->id);


        $this->assertDatabaseCount('languages', 0);

        $response->assertStatus(200);
    }

    /**
    * test get all languages Crud.
    *
    * @return void
    */
    public function test_languages_get_all_CRUD()
    {
        $token = $this->authenticate('crud');
        $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
        $language = Language::create(["name_en" => "Second Edition","name_es" => "Segunda Edición","meaning_name_en" => "This is the Second time in one edition.","meaning_name_es" => "Esta es la Segunda edición."]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/languages');

        $response->assertJson([
             [
                 "name_en" => "First Edition",
                 "name_es" => "Primera Edición",
                 "meaning_name_en" => "This is the first time in one edition.",
                 "meaning_name_es" => "Esta es la primera edición."
             ],
             [
                 "name_en" => "Second Edition",
                 "name_es" => "Segunda Edición",
                 "meaning_name_en" => "This is the Second time in one edition.",
                 "meaning_name_es" => "Esta es la Segunda edición."
             ]
         ]);

         $this->assertDatabaseCount('languages', 2);

         $this->assertDatabaseHas('languages', [
             "name_es" => "Segunda Edición"
         ]);

        $response->assertStatus(200);
    }

     /**
      * test find Language CRUD.
      *
      * @return void
      */
     public function test_languages_find_CRUD()
     {
         $token = $this->authenticate('crud');
         $language = Language::create(["name_en" => "Third Edition","name_es" => "Tercera Edición","meaning_name_en" => "This is the Third time in one edition.","meaning_name_es" => "Esta es la tercera edición."]);
         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('GET','api/languages/'.$language->id);

         $this->assertDatabaseHas('languages', [
             "name_es" => "Tercera Edición"
         ]);
         $response->assertStatus(200);
     }

         /**
      * test create Language CRUD.
      *
      * @return void
      */
     public function test_languages_create_CRUD()
     {
         $token = $this->authenticate('crud');

         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('POST','api/languages',[
             "name_en" => "First Edition",
             "name_es" => "Primera Edición",
             "meaning_name_en" => "This is the first time in one edition.",
             "meaning_name_es" => "Esta es la primera edición."
         ]);
         $this->assertDatabaseCount('languages', 1);
         $response->assertStatus(200);
     }

     /**
      * test update Language CRUD.
      *
      * @return void
      */
     public function test_languages_update_CRUD()
     {
         $token = $this->authenticate('crud');
         $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('PUT','api/languages/'.$language->id,[
             "name_en" => "First Edition Update",
             "name_es" => "Primera Edición Actualizada",
             "meaning_name_en" => "This is the first time in one edition Updated.",
             "meaning_name_es" => "Esta es la primera edición Actualizada."
         ]);

         $this->assertDatabaseHas('languages', [
             "name_en" => "First Edition Update",
             "meaning_name_en" => "This is the first time in one edition Updated."
         ]);

         $response->assertStatus(200);
     }

     /**
      * test delete languages Crud.
      *
      * @return void
      */
     public function test_languages_delete_CRUD()
     {
         $token = $this->authenticate('crud');
         $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('DELETE','api/languages/'.$language->id);


         $this->assertDatabaseCount('languages', 0);

         $response->assertStatus(200);
    }

    /**
    * test get all languages Crud.
    *
    * @return void
    */
    public function test_languages_get_all_CRU()
    {
        $token = $this->authenticate('cru');
        $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
        $language = Language::create(["name_en" => "Second Edition","name_es" => "Segunda Edición","meaning_name_en" => "This is the Second time in one edition.","meaning_name_es" => "Esta es la Segunda edición."]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/languages');

        $response->assertJson([
             [
                 "name_en" => "First Edition",
                 "name_es" => "Primera Edición",
                 "meaning_name_en" => "This is the first time in one edition.",
                 "meaning_name_es" => "Esta es la primera edición."
             ],
             [
                 "name_en" => "Second Edition",
                 "name_es" => "Segunda Edición",
                 "meaning_name_en" => "This is the Second time in one edition.",
                 "meaning_name_es" => "Esta es la Segunda edición."
             ]
         ]);

         $this->assertDatabaseCount('languages', 2);

         $this->assertDatabaseHas('languages', [
             "name_es" => "Segunda Edición"
         ]);

        $response->assertStatus(200);
    }

     /**
      * test find Language CRU.
      *
      * @return void
      */
     public function test_languages_find_CRU()
     {
         $token = $this->authenticate('cru');
         $language = Language::create(["name_en" => "Third Edition","name_es" => "Tercera Edición","meaning_name_en" => "This is the Third time in one edition.","meaning_name_es" => "Esta es la tercera edición."]);
         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('GET','api/languages/'.$language->id);

         $this->assertDatabaseHas('languages', [
             "name_es" => "Tercera Edición"
         ]);
         $response->assertStatus(200);
     }

         /**
      * test create Language CRU.
      *
      * @return void
      */
     public function test_languages_create_CRU()
     {
         $token = $this->authenticate('cru');

         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('POST','api/languages',[
             "name_en" => "First Edition",
             "name_es" => "Primera Edición",
             "meaning_name_en" => "This is the first time in one edition.",
             "meaning_name_es" => "Esta es la primera edición."
         ]);
         $this->assertDatabaseCount('languages', 1);
         $response->assertStatus(200);
     }

     /**
      * test update Language CRU.
      *
      * @return void
      */
     public function test_languages_update_CRU()
     {
         $token = $this->authenticate('cru');
         $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
         $response = $this->withHeaders([
             'Authorization' => 'Bearer '. $token,
         ])->json('PUT','api/languages/'.$language->id,[
             "name_en" => "First Edition Update",
             "name_es" => "Primera Edición Actualizada",
             "meaning_name_en" => "This is the first time in one edition Updated.",
             "meaning_name_es" => "Esta es la primera edición Actualizada."
         ]);

         $this->assertDatabaseHas('languages', [
             "name_en" => "First Edition Update",
             "meaning_name_en" => "This is the first time in one edition Updated."
         ]);

         $response->assertStatus(200);
     }


    /**
     * test delete languages CRU NOT ALLOWED.
     *
     * @return void
     */
    public function test_languages_delete_CRU_not_allowed()
    {
        $token = $this->authenticate('cru');
        $language = Language::create(["name_en" => "First Edition","name_es" => "Primera Edición","meaning_name_en" => "This is the first time in one edition.","meaning_name_es" => "Esta es la primera edición."]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE','api/languages/'.$language->id);

        $this->assertDatabaseCount('languages', 1);
        $this->assertEquals('Unauthorized', $response['message']);
        $response->assertUnauthorized();
    }
}
