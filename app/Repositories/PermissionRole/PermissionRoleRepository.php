<?php

namespace App\Repositories\PermissionRole; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\PermissionRole;

class PermissionRoleRepository  implements PermissionRoleRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return PermissionRole::all();
   }
   /*
    * Return all Detail
    * @return  mixed
   */
   public function allDetails($search)
   { 
     $select =PermissionRole::select( 
                  'permission_roles.id',   
                  'roles.name AS Role',   
                  'permissions.name AS Permission' 
                  )     
                ->join('roles','permission_roles.role_id','=','roles.id')    
                ->join('permissions','permission_roles.permission_id','=','permissions.id') ;   
                if($search != null){
                    $select 
                      ->orWhereRaw("roles.name LIKE '%".$search."%'") 
                      ->orWhereRaw("permissions.name LIKE '%".$search."%'"); 
                }

     return $select->get();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($permissionRole)
    {
      return PermissionRole::find($permissionRole);
   }

   /**
    * Save PermissionRole
     *
     * @return  mixed
   */
    public function store($data)
    {
      return PermissionRole::create(array(
        'role_id' => $data['role_id'],
        'permission_id' => $data['permission_id'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update PermissionRole
     *
     * @return  mixed
   */
   public function update($permissionRole,$data)
     {
      //Find PermissionRole
      $permissionRole = PermissionRole::find($permissionRole);
      $permissionRole->fill(array(
        'role_id' => $data['role_id'],
        'permission_id' => $data['permission_id'],
        'updated_at' => Carbon::now()
      ));
      return $permissionRole->save();
   }


   /**
    *Delete PermissionRole
     *
     * @return  mixed
   */
   public function destroy($permissionRole)
     {
      //Find PermissionRole
      $permissionRole = PermissionRole::find($permissionRole);
      return $permissionRole->delete();
   }

}