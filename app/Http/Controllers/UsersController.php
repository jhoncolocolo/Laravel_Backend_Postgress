<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller 
{ 
   /**
    * @var  UsersRepositoryInterface
   */

   private $userRepository;

   /**
    *UsersController constructor.
     *
     * @param  UserRepositoryInterface $userRepository
    */
   public function __construct(UserRepositoryInterface $userRepository)
   {
      $this->userRepository = $userRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function index(Request $request)
	 {
        return response()->json($this->userRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($user){   
       return response()->json($this->userRepository->show($user));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
	 {
       //Save Users
       $user = $this->userRepository->store($request);
       $data = [];
       if ($user) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $user->id;
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
   public function update($user,Request $request)
	 {
       //Update Users
       $user = $this->userRepository->update($user, $request);
       $data = [];
       if ($user) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['user_id'] = $user;
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
   public function destroy($user)
	 {
       //Delete Users
       $user = $this->userRepository->destroy($user);
       $data = [];
       if ($user) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}