<?php

namespace App\Services\PermissionUser; 
use App\Repositories\PermissionUser\PermissionUserRepository;

class PermissionUserService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new PermissionUserRepository())->all();
    }

    /**
    *Return all Registries With Detail
     *
     * @return  mixed
    */
    public function allDetails($search)
    {
      return (new PermissionUserRepository())->allDetails($search);
    } 

   /*
    * Get PermissionUser By Id
    * @param  $permissionUserId Int
    */
    public function find($permissionUserId)
    {
        return (new PermissionUserRepository())->show($permissionUserId);
    }

    /*
    * Do PermissionUser
    * @param  $data Array
    */
    public function store($data)
    {
        //Save PermissionUser
        return (new PermissionUserRepository())->store($data);
    }

    /*
    * Update PermissionUser
    * @param  $permissionUserId Int
    * @param  $data Array
    */
    public function update($permissionUserId, $data)
    {
        //Update PermissionUser
        return (new PermissionUserRepository())->update($permissionUserId, $data);
    }

    /*
    * Delete PermissionUser
    * @param  $permissionUserId Int
    */
    public function destroy($permissionUserId)
    {
        //Delete PermissionUser
        return (new PermissionUserRepository())->destroy($permissionUserId);
    }
}