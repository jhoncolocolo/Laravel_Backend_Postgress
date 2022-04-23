<?php

namespace App\Repositories\Role; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\Role;

class RoleRepository  implements RoleRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return Role::all();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($role)
    {
      return Role::find($role);
   }

   /**
    * Save Role
     *
     * @return  mixed
   */
    public function store($data)
    {
      return Role::create(array(
        'name' => $data['name'],
        'role' => $data['role'],
        'description' => $data['description'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update Role
     *
     * @return  mixed
   */
   public function update($role,$data)
     {
      //Find Role
      $role = Role::find($role);
      $role->fill(array(
        'name' => $data['name'],
        'role' => $data['role'],
        'description' => $data['description'],
        'updated_at' => Carbon::now()
      ));
      return $role->save();
   }


   /**
    *Delete Role
     *
     * @return  mixed
   */
   public function destroy($role)
     {
      //Find Role
      $role = Role::find($role);
      return $role->delete();
   }

}