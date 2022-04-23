<?php

namespace App\Repositories\PermissionUser;

interface PermissionUserRepositoryInterface { 
   public function all();
   public function allDetails($search);
   public function show($permissionUser);
   public function store($data);
   public function update($permissionUser,$data);
   public function destroy($permissionUser);
}