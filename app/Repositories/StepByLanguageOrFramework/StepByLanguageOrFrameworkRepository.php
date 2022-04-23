<?php

namespace App\Repositories\StepByLanguageOrFramework; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use App\Models\StepByLanguageOrFramework;

class StepByLanguageOrFrameworkRepository  implements StepByLanguageOrFrameworkRepositoryInterface
{ 
   /**
    *Return all values
     *
     * @return  mixed
   */
   public function all()
	 {
      return StepByLanguageOrFramework::select(
                  'step_by_language_or_frameworks.id',
                  DB::raw('case when language_id = 2 then "PHP" when language_id = 3 then "NODE JS" when language_id = 4 then "GOLANG" when language_id = 5  then "PYTHON" when language_id = 6  then "JAVASCRIPT" else "GENERAL" end AS language_id'),  
                  DB::raw('case when framework_id = 2 then "LARAVEL" when framework_id = 3 then "VUE JS" when framework_id = 4 then "ANGULAR JS" when framework_id = 5  then "REACTS JS" else "NO APLICA" end AS framework_id'),     
                  'step_by_language_or_frameworks.step',  
                  'step_by_language_or_frameworks.name',   
                  'step_by_language_or_frameworks.photo',   
                  'step_by_language_or_frameworks.ref_urls',   
                  'step_by_language_or_frameworks.description')->get();
   }
   /*
    * Return all Detail
    * @return  mixed
   */
   public function allDetails($search)
   { 
     $select =StepByLanguageOrFramework::select( 
                  DB::raw('case when language_id = 1 then "PHP" when language_id = 2 then "NODE JS" when language_id = 3 then "GOLANG" when language_id = 4  then "PYTHON" else "JAVASCRIPT" end AS Language'),  
                  DB::raw('case when language_id = 1 then "LARAVEL" when language_id = 2 then "VUE JS" when language_id = 3 then "ANGULAR JS" when language_id = 4  then "REACTS JS" else "SVELTE" end AS Framework'),     
                  'step_by_language_or_frameworks.step',  
                  'step_by_language_or_frameworks.name',   
                  'step_by_language_or_frameworks.description' 
                  );   
                if($search != null){
                    $select 
                      ->orWhereRaw('step_by_language_or_frameworks.language_id LIKE "%'.$search.'%"') 
                      ->orWhereRaw("step_by_language_or_frameworks.framework_id LIKE '%".$search."%'") 
                      ->orWhereRaw("step_by_language_or_frameworks.name LIKE '%".$search."%'") 
                      ->orWhereRaw("step_by_language_or_frameworks.description LIKE '%".$search."%'");
                }

     return $select->get();
   }
   
    /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($stepByLanguageOrFramework)
    {
      return StepByLanguageOrFramework::find($stepByLanguageOrFramework);
   }

   /**
    * Save StepByLanguageOrFramework
     *
     * @return  mixed
   */
    public function store($data)
    {
      return StepByLanguageOrFramework::create(array(
        'language_id' => $data['language_id'],
        'framework_id' => $data['framework_id'],
        "step" => $data['step'],
        'name' => $data['name'],
        'description' => $data['description'],
        'photo' => $data['photo'],
        'ref_urls' => $data['ref_urls'],
        'created_at' => Carbon::now()
      ));
    }

   /**
    *Update StepByLanguageOrFramework
     *
     * @return  mixed
   */
   public function update($stepByLanguageOrFramework,$data)
     {
      //Find StepByLanguageOrFramework
      $stepByLanguageOrFramework = StepByLanguageOrFramework::find($stepByLanguageOrFramework);
      $stepByLanguageOrFramework->fill(array(
        'language_id' => $data['language_id'],
        'framework_id' => $data['framework_id'],
        "step" => $data['step'],
        'name' => $data['name'],
        'description' => $data['description'],
        'photo' => $data['photo'],
        'ref_urls' => $data['ref_urls'],
        'updated_at' => Carbon::now()
      ));
      return $stepByLanguageOrFramework->save();
   }


   /**
    *Delete StepByLanguageOrFramework
     *
     * @return  mixed
   */
   public function destroy($stepByLanguageOrFramework)
     {
      //Find StepByLanguageOrFramework
      $stepByLanguageOrFramework = StepByLanguageOrFramework::find($stepByLanguageOrFramework);
      return $stepByLanguageOrFramework->delete();
   }

    public function getStepsByLanguage($language){   
       return StepByLanguageOrFramework::where('language_id',$language)->orderBy('step')->get();
    }

    public function getStepsByFramework($framework){   
       return StepByLanguageOrFramework::where('framework_id',$framework)->orderBy('step')->get();
    }
}