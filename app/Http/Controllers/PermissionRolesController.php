<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\PermissionRole\PermissionRoleRepositoryInterface;

class PermissionRolesController extends Controller 
{ 
   /**
    * @var  PermissionRolesRepositoryInterface
   */

   private $permissionRoleRepository;

   /**
    *PermissionRolesController constructor.
     *
     * @param  PermissionRoleRepositoryInterface $permissionRoleRepository
    */
   public function __construct(PermissionRoleRepositoryInterface $permissionRoleRepository)
   {
      $this->permissionRoleRepository = $permissionRoleRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function index(Request $request)
     {
        return response()->json($this->permissionRoleRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($permissionRole){   
       return response()->json($this->permissionRoleRepository->show($permissionRole));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
     {
       //Save PermissionRoles
       $permissionRole = $this->permissionRoleRepository->store($request);
       $data = [];
       if ($permissionRole) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $permissionRole->id;
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
   public function update($permissionRole,Request $request)
     {
       //Update PermissionRoles
       $permissionRole = $this->permissionRoleRepository->update($permissionRole, $request);
       $data = [];
       if ($permissionRole) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['permissionRole_id'] = $permissionRole;
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
   public function destroy($permissionRole)
     {
       //Delete PermissionRoles
       $permissionRole = $this->permissionRoleRepository->destroy($permissionRole);
       $data = [];
       if ($permissionRole) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}