<?php

namespace App\Repositories\Language;

interface LanguageRepositoryInterface { 
   public function all();
   public function show($language);
   public function store($data);
   public function update($language,$data);
   public function destroy($language);
}