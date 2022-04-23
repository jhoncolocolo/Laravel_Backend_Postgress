<?php

namespace App\Services\Role; 
use App\Repositories\Role\RoleRepository;

class RoleService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new RoleRepository())->all();
    }


   /*
    * Get Role By Id
    * @param  $roleId Int
    */
    public function find($roleId)
    {
        return (new RoleRepository())->show($roleId);
    }

    /*
    * Do Role
    * @param  $data Array
    */
    public function store($data)
    {
        //Save Role
        return (new RoleRepository())->store($data);
    }

    /*
    * Update Role
    * @param  $roleId Int
    * @param  $data Array
    */
    public function update($roleId, $data)
    {
        //Update Role
        return (new RoleRepository())->update($roleId, $data);
    }

    /*
    * Delete Role
    * @param  $roleId Int
    */
    public function destroy($roleId)
    {
        //Delete Role
        return (new RoleRepository())->destroy($roleId);
    }
}