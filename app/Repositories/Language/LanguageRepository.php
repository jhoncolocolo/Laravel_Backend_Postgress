<?php

namespace App\Repositories\Language; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\Language;

class LanguageRepository  implements LanguageRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return Language::all();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($language)
    {
      return Language::find($language);
   }

   /**
    * Save Language
     *
     * @return  mixed
   */
    public function store($data)
    {
      return Language::create(array(
        'name_en' => $data['name_en'],
        'name_es' => $data['name_es'],
        'meaning_name_en' => $data['meaning_name_en'],
        'meaning_name_es' => $data['meaning_name_es'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update Language
     *
     * @return  mixed
   */
   public function update($language,$data)
     {
      //Find Language
      $language = Language::find($language);
      $language->fill(array(
        'name_en' => $data['name_en'],
        'name_es' => $data['name_es'],
        'meaning_name_en' => $data['meaning_name_en'],
        'meaning_name_es' => $data['meaning_name_es'],
        'updated_at' => Carbon::now()
      ));
      return $language->save();
   }


   /**
    *Delete Language
     *
     * @return  mixed
   */
   public function destroy($language)
     {
      //Find Language
      $language = Language::find($language);
      return $language->delete();
   }

}