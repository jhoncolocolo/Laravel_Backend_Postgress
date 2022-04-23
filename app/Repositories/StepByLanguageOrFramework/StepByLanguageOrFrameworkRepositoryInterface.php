<?php

namespace App\Repositories\StepByLanguageOrFramework;

interface StepByLanguageOrFrameworkRepositoryInterface { 
   public function all();
   public function allDetails($search);
   public function show($stepByLanguageOrFramework);
   public function store($data);
   public function update($stepByLanguageOrFramework,$data);
   public function destroy($stepByLanguageOrFramework);
   public function getStepsByLanguage($language);
   public function getStepsByFramework($framework);
}