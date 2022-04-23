<?php

namespace App\Services\Permission; 
use App\Repositories\Permission\PermissionRepository;

class PermissionService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new PermissionRepository())->all();
    }


   /*
    * Get Permission By Id
    * @param  $permissionId Int
    */
    public function find($permissionId)
    {
        return (new PermissionRepository())->show($permissionId);
    }

    /*
    * Do Permission
    * @param  $data Array
    */
    public function store($data)
    {
        //Save Permission
        return (new PermissionRepository())->store($data);
    }

    /*
    * Update Permission
    * @param  $permissionId Int
    * @param  $data Array
    */
    public function update($permissionId, $data)
    {
        //Update Permission
        return (new PermissionRepository())->update($permissionId, $data);
    }

    /*
    * Delete Permission
    * @param  $permissionId Int
    */
    public function destroy($permissionId)
    {
        //Delete Permission
        return (new PermissionRepository())->destroy($permissionId);
    }
}