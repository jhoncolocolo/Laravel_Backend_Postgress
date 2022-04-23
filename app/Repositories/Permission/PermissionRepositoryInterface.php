<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface { 
   public function all();
   public function show($permission);
   public function store($data);
   public function update($permission,$data);
   public function destroy($permission);
}