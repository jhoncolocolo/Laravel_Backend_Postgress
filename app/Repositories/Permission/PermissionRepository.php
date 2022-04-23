<?php

namespace App\Repositories\Permission; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\Permission;

class PermissionRepository  implements PermissionRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return Permission::all();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($permission)
    {
      return Permission::find($permission);
   }

   /**
    * Save Permission
     *
     * @return  mixed
   */
    public function store($data)
    {
      return Permission::create(array(
        'name' => $data['name'],
        'route' => $data['route'],
        'path' => $data['path'],
        'description' => $data['description'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update Permission
     *
     * @return  mixed
   */
   public function update($permission,$data)
     {
      //Find Permission
      $permission = Permission::find($permission);
      $permission->fill(array(
        'name' => $data['name'],
        'route' => $data['route'],
        'path' => $data['path'],
        'description' => $data['description'],
        'updated_at' => Carbon::now()
      ));
      return $permission->save();
   }


   /**
    *Delete Permission
     *
     * @return  mixed
   */
   public function destroy($permission)
     {
      //Find Permission
      $permission = Permission::find($permission);
      return $permission->delete();
   }

}