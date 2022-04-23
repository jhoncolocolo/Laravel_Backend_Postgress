<?php

namespace App\Services\StepByLanguageOrFramework; 
use App\Repositories\StepByLanguageOrFramework\StepByLanguageOrFrameworkRepository;

class StepByLanguageOrFrameworkService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new StepByLanguageOrFrameworkRepository())->all();
    }

    /**
    *Return all Registries With Detail
     *
     * @return  mixed
    */
    public function allDetails($search)
    {
      return (new StepByLanguageOrFrameworkRepository())->allDetails($search);
    } 

   /*
    * Get StepByLanguageOrFramework By Id
    * @param  $StepByLanguageOrFrameworkId Int
    */
    public function find($StepByLanguageOrFrameworkId)
    {
        return (new StepByLanguageOrFrameworkRepository())->show($StepByLanguageOrFrameworkId);
    }

    /*
    * Do StepByLanguageOrFramework
    * @param  $data Array
    */
    public function store($data)
    {
        //Save StepByLanguageOrFramework
        return (new StepByLanguageOrFrameworkRepository())->store($data);
    }

    /*
    * Update StepByLanguageOrFramework
    * @param  $StepByLanguageOrFrameworkId Int
    * @param  $data Array
    */
    public function update($StepByLanguageOrFrameworkId, $data)
    {
        //Update StepByLanguageOrFramework
        return (new StepByLanguageOrFrameworkRepository())->update($StepByLanguageOrFrameworkId, $data);
    }

    /*
    * Delete StepByLanguageOrFramework
    * @param  $StepByLanguageOrFrameworkId Int
    */
    public function destroy($StepByLanguageOrFrameworkId)
    {
        //Delete StepByLanguageOrFramework
        return (new StepByLanguageOrFrameworkRepository())->destroy($StepByLanguageOrFrameworkId);
    }
}