<?php

namespace App\Repositories\PermissionRole;

interface PermissionRoleRepositoryInterface { 
   public function all();
   public function allDetails($search);
   public function show($permissionRole);
   public function store($data);
   public function update($permissionRole,$data);
   public function destroy($permissionRole);
}