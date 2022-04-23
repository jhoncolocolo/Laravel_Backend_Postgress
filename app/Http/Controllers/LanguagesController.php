<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Language\LanguageRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewLanguageRegisteredNotification;

class LanguagesController extends Controller 
{ 
   /**
    * @var  LanguagesRepositoryInterface
   */

   private $languageRepository;

   /**
    *LanguagesController constructor.
     *
     * @param  LanguageRepositoryInterface $languageRepository
    */
   public function __construct(LanguageRepositoryInterface $languageRepository)
   {
      $this->languageRepository = $languageRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function index(Request $request)
	 {
        return response()->json($this->languageRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($language){   
       return response()->json($this->languageRepository->show($language));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
	 {
       //Save Languages
        $language = $this->languageRepository->store($request);
        $users = \User::all();
        Notification::send($users,new NewLanguageRegisteredNotification());

       $data = [];
       if ($language) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $language->id;
       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Entered Successfully';
       }
       return response()->json($data);
  }


   /**
    *Update the specified resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function update($language,Request $request)
	 {
       //Update Languages
       $language = $this->languageRepository->update($language, $request);
       $data = [];
       if ($language) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['language_id'] = $language;
       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Update Successfully';
       }
       return response()->json($data);
  }


   /**
    *Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function destroy($language)
	 {
       //Delete Languages
       $language = $this->languageRepository->destroy($language);
       $data = [];
       if ($language) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}