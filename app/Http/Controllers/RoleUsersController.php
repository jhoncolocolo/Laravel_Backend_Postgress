<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\RoleUser\RoleUserRepositoryInterface;

class RoleUsersController extends Controller 
{ 
   /**
    * @var  RoleUsersRepositoryInterface
   */

   private $roleUserRepository;

   /**
    *RoleUsersController constructor.
     *
     * @param  RoleUserRepositoryInterface $roleUserRepository
    */
   public function __construct(RoleUserRepositoryInterface $roleUserRepository)
   {
      $this->roleUserRepository = $roleUserRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function index(Request $request)
	 {
        return response()->json($this->roleUserRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($roleUser){   
       return response()->json($this->roleUserRepository->show($roleUser));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
	 {
       //Save RoleUsers
       $roleUser = $this->roleUserRepository->store($request);
       $data = [];
       if ($roleUser) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $roleUser->id;
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
   public function update($roleUser,Request $request)
	 {
       //Update RoleUsers
       $roleUser = $this->roleUserRepository->update($roleUser, $request);
       $data = [];
       if ($roleUser) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['roleUser_id'] = $roleUser;
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
   public function destroy($roleUser)
	 {
       //Delete RoleUsers
       $roleUser = $this->roleUserRepository->destroy($roleUser);
       $data = [];
       if ($roleUser) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}