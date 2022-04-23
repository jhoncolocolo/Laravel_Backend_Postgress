<?php

namespace App\Services\PermissionRole; 
use App\Repositories\PermissionRole\PermissionRoleRepository;

class PermissionRoleService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new PermissionRoleRepository())->all();
    }

    /**
    *Return all Registries With Detail
     *
     * @return  mixed
    */
    public function allDetails($search)
    {
      return (new PermissionRoleRepository())->allDetails($search);
    } 

   /*
    * Get PermissionRole By Id
    * @param  $permissionRoleId Int
    */
    public function find($permissionRoleId)
    {
        return (new PermissionRoleRepository())->show($permissionRoleId);
    }

    /*
    * Do PermissionRole
    * @param  $data Array
    */
    public function store($data)
    {
        //Save PermissionRole
        return (new PermissionRoleRepository())->store($data);
    }

    /*
    * Update PermissionRole
    * @param  $permissionRoleId Int
    * @param  $data Array
    */
    public function update($permissionRoleId, $data)
    {
        //Update PermissionRole
        return (new PermissionRoleRepository())->update($permissionRoleId, $data);
    }

    /*
    * Delete PermissionRole
    * @param  $permissionRoleId Int
    */
    public function destroy($permissionRoleId)
    {
        //Delete PermissionRole
        return (new PermissionRoleRepository())->destroy($permissionRoleId);
    }
}