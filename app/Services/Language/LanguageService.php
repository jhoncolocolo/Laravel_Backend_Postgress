<?php

namespace App\Services\Language; 
use App\Repositories\Language\LanguageRepository;

class LanguageService
{ 
    /**
    *Return all values
     *
     * @return  mixed
    */
    public function all()
	{
      return (new LanguageRepository())->all();
    }


   /*
    * Get Language By Id
    * @param  $languageId Int
    */
    public function find($languageId)
    {
        return (new LanguageRepository())->show($languageId);
    }

    /*
    * Do Language
    * @param  $data Array
    */
    public function store($data)
    {
        //Save Language
        return (new LanguageRepository())->store($data);
    }

    /*
    * Update Language
    * @param  $languageId Int
    * @param  $data Array
    */
    public function update($languageId, $data)
    {
        //Update Language
        return (new LanguageRepository())->update($languageId, $data);
    }

    /*
    * Delete Language
    * @param  $languageId Int
    */
    public function destroy($languageId)
    {
        //Delete Language
        return (new LanguageRepository())->destroy($languageId);
    }
}