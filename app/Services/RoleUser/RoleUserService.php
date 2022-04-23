<?php

namespace App\Services\RoleUser; 
use App\Repositories\RoleUser\RoleUserRepository;

class RoleUserService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new RoleUserRepository())->all();
    }

    /**
    *Return all Registries With Detail
     *
     * @return  mixed
    */
    public function allDetails($search)
    {
      return (new RoleUserRepository())->allDetails($search);
    } 

   /*
    * Get RoleUser By Id
    * @param  $roleUserId Int
    */
    public function find($roleUserId)
    {
        return (new RoleUserRepository())->show($roleUserId);
    }

    /*
    * Do RoleUser
    * @param  $data Array
    */
    public function store($data)
    {
        //Save RoleUser
        return (new RoleUserRepository())->store($data);
    }

    /*
    * Update RoleUser
    * @param  $roleUserId Int
    * @param  $data Array
    */
    public function update($roleUserId, $data)
    {
        //Update RoleUser
        return (new RoleUserRepository())->update($roleUserId, $data);
    }

    /*
    * Delete RoleUser
    * @param  $roleUserId Int
    */
    public function destroy($roleUserId)
    {
        //Delete RoleUser
        return (new RoleUserRepository())->destroy($roleUserId);
    }
}