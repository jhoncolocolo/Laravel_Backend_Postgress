<?php

namespace App\Repositories\User; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\User;

class UserRepository  implements UserRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return User::where('id','<>',10)->get();
      //return User::all();
      //return User::limit(2)->get();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($user)
    {
      return User::with( ['permission_by_users' => function ($query) use ($user) {
                $query->select(
                  'user_id',
                  'roles.id AS role_id',
                  'roles.name AS role',
                  'permissions.route',
                  'permissions.path',
                  "permissions.description"
                )
                ->where('role_users.user_id', $user)
                ->orwhereRaw("(role_users.role_id = 1 and role_users.user_id =".$user.")");
        }])->find($user);
   }

   /**
    * Save User
     *
     * @return  mixed
   */
    public function store($data)
    {
      return User::create(array(
        'name' => $data['name'],
        'email' => $data['email'],
        'email_verified_at' => $data['email_verified_at'],
        'password' => $data['password'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update User
     *
     * @return  mixed
   */
   public function update($user,$data)
     {
      //Find User
      $user = User::find($user);
      $user->fill(array(
        'name' => $data['name'],
        'email' => $data['email'],
        'email_verified_at' => $data['email_verified_at'],
        'password' => $data['password'],
        'updated_at' => Carbon::now()
      ));
      return $user->save();
   }


   /**
    *Delete User
     *
     * @return  mixed
   */
   public function destroy($user)
     {
      //Find User
      $user = User::find($user);
      return $user->delete();
   }

}