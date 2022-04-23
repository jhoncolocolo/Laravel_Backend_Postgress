<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface { 
   public function all();
   public function show($role);
   public function store($data);
   public function update($role,$data);
   public function destroy($role);
}