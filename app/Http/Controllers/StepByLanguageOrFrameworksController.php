<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\StepByLanguageOrFramework\StepByLanguageOrFrameworkRepositoryInterface;
use Storage;
use App\Mail\NewStepForLanguage;
use Illuminate\Support\Facades\Mail;
use App\Events\NewStepLanguageRegisteredEvent;

class StepByLanguageOrFrameworksController extends Controller 
{ 
   /**
    * @var  StepByLanguageOrFrameworksRepositoryInterface
   */

   private $stepByLanguageOrFrameworkRepository;

   /**
    *StepByLanguageOrFrameworksController constructor.
     *
     * @param  StepByLanguageOrFrameworkRepositoryInterface $stepByLanguageOrFrameworkRepository
    */
   public function __construct(StepByLanguageOrFrameworkRepositoryInterface $stepByLanguageOrFrameworkRepository)
   {
      $this->stepByLanguageOrFrameworkRepository = $stepByLanguageOrFrameworkRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
    public function index(Request $request)
	{
        return response()->json($this->stepByLanguageOrFrameworkRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($stepByLanguageOrFramework){   
       return response()->json($this->stepByLanguageOrFrameworkRepository->show($stepByLanguageOrFramework));
   }

   public function getStepsByLanguage($language){ 
       return response()->json($this->stepByLanguageOrFrameworkRepository->getStepsByLanguage($language));
   }

   public function getStepsByFramework($framework){  
       return response()->json($this->stepByLanguageOrFrameworkRepository->getStepsByFramework($framework));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
	 {
       // dd($request->all());
       //Save StepByLanguageOrFrameworks
       $stepByLanguageOrFramework = $this->stepByLanguageOrFrameworkRepository->store($request);
       //Inject Info Class Mail
        /*$email = new NewStepForLanguage($stepByLanguageOrFramework);
        Mail::to("your_destinatary@gmail.com")->send($email);*/

        event(new NewStepLanguageRegisteredEvent($stepByLanguageOrFramework));
        if($request->file('photo')){ // Si se envio una imagen
            $path = Storage::disk('public_uploads')->put('images/steps', $request->file('photo')); //Store the image on the disk keep in mind that the image will be stored in the public folder of the filsystem configuration file in the put we define the folder in which the image will be saved
            $stepByLanguageOrFramework->fill(['photo' => $path])->save();
        }
       $data = [];
       if ($stepByLanguageOrFramework) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $stepByLanguageOrFramework->id;
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
   public function update($stepByLanguageOrFramework,Request $request)
	 {
       //Update StepByLanguageOrFrameworks
       $stepByLanguageOrFramework = $this->stepByLanguageOrFrameworkRepository->update($stepByLanguageOrFramework, $request);
       $data = [];
       if ($stepByLanguageOrFramework) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['step_id'] = $stepByLanguageOrFramework;
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
   public function destroy($stepByLanguageOrFramework)
	 {
       //Delete StepByLanguageOrFrameworks
      $stepByLanguageOrFramework = $this->stepByLanguageOrFrameworkRepository->destroy($stepByLanguageOrFramework);
       $data = [];
       if ($stepByLanguageOrFramework) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}