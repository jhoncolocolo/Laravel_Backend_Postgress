<?php

namespace App\Repositories\RoleUser; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\RoleUser;

class RoleUserRepository  implements RoleUserRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return RoleUser::all();
   }
   /*
    * Return all Detail
    * @return  mixed
   */
   public function allDetails($search)
   { 
     $select =RoleUser::select( 
                  'role_users.id',   
                  'roles.name AS Role',   
                  'users.name AS User' 
                  )     
                ->join('roles','role_users.role_id','=','roles.id')    
                ->join('users','role_users.user_id','=','users.id') ;   
                if($search != null){
                    $select 
                      ->orWhereRaw("roles.name LIKE '%".$search."%'") 
                      ->orWhereRaw("users.name LIKE '%".$search."%'"); 
                }

     return $select->get();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($roleUser)
    {
      return RoleUser::find($roleUser);
   }

   /**
    * Save RoleUser
     *
     * @return  mixed
   */
    public function store($data)
    {
      return RoleUser::create(array(
        'role_id' => $data['role_id'],
        'user_id' => $data['user_id'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update RoleUser
     *
     * @return  mixed
   */
   public function update($roleUser,$data)
     {
      //Find RoleUser
      $roleUser = RoleUser::find($roleUser);
      $roleUser->fill(array(
        'role_id' => $data['role_id'],
        'user_id' => $data['user_id'],
        'updated_at' => Carbon::now()
      ));
      return $roleUser->save();
   }


   /**
    *Delete RoleUser
     *
     * @return  mixed
   */
   public function destroy($roleUser)
     {
      //Find RoleUser
      $roleUser = RoleUser::find($roleUser);
      return $roleUser->delete();
   }

}