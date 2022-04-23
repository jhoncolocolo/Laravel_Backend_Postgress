<?php

namespace App\Repositories\PermissionUser; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\PermissionUser;

class PermissionUserRepository  implements PermissionUserRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return PermissionUser::all();
   }
   /*
    * Return all Detail
    * @return  mixed
   */
   public function allDetails($search)
   { 
     $select =PermissionUser::select( 
                  'permission_users.id',   
                  'permissions.name AS Permission',   
                  'users.name AS User' 
                  )     
                ->join('permissions','permission_users.permission_id','=','permissions.id')    
                ->join('users','permission_users.user_id','=','users.id') ;   
                if($search != null){
                    $select 
                      ->orWhereRaw("permissions.name LIKE '%".$search."%'") 
                      ->orWhereRaw("users.name LIKE '%".$search."%'"); 
                }

     return $select->get();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($permissionUser)
    {
      return PermissionUser::find($permissionUser);
   }

   /**
    * Save PermissionUser
     *
     * @return  mixed
   */
    public function store($data)
    {
      return PermissionUser::create(array(
        'permission_id' => $data['permission_id'],
        'user_id' => $data['user_id'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update PermissionUser
     *
     * @return  mixed
   */
   public function update($permissionUser,$data)
     {
      //Find PermissionUser
      $permissionUser = PermissionUser::find($permissionUser);
      $permissionUser->fill(array(
        'permission_id' => $data['permission_id'],
        'user_id' => $data['user_id'],
        'updated_at' => Carbon::now()
      ));
      return $permissionUser->save();
   }


   /**
    *Delete PermissionUser
     *
     * @return  mixed
   */
   public function destroy($permissionUser)
     {
      //Find PermissionUser
      $permissionUser = PermissionUser::find($permissionUser);
      return $permissionUser->delete();
   }

}