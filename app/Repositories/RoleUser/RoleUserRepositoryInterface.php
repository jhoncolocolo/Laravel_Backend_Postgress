<?php

namespace App\Repositories\RoleUser;

interface RoleUserRepositoryInterface { 
   public function all();
   public function allDetails($search);
   public function show($roleUser);
   public function store($data);
   public function update($roleUser,$data);
   public function destroy($roleUser);
}