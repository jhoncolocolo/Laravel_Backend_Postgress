<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Role\RoleRepositoryInterface;

class RolesController extends Controller 
{ 
   /**
    * @var  RolesRepositoryInterface
   */

   private $roleRepository;

   /**
    *RolesController constructor.
     *
     * @param  RoleRepositoryInterface $roleRepository
    */
   public function __construct(RoleRepositoryInterface $roleRepository)
   {
      $this->roleRepository = $roleRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function index(Request $request)
	 {
        return response()->json($this->roleRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($role){   
       return response()->json($this->roleRepository->show($role));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
	 {
       //Save Roles
       $role = $this->roleRepository->store($request);
       $data = [];
       if ($role) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $role->id;
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
   public function update($role,Request $request)
	 {
       //Update Roles
       $role = $this->roleRepository->update($role, $request);
       $data = [];
       if ($role) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['role_id'] = $role;
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
   public function destroy($role)
	 {
       //Delete Roles
       $role = $this->roleRepository->destroy($role);
       $data = [];
       if ($role) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}