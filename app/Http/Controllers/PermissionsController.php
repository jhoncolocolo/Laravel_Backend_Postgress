<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionsController extends Controller 
{ 
   /**
    * @var  PermissionsRepositoryInterface
   */

   private $permissionRepository;

   /**
    *PermissionsController constructor.
     *
     * @param  PermissionRepositoryInterface $permissionRepository
    */
   public function __construct(PermissionRepositoryInterface $permissionRepository)
   {
      $this->permissionRepository = $permissionRepository;
   }


   /**
    *Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function index(Request $request)
     {
        return response()->json($this->permissionRepository->all());
    }
   /**
    *Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
   */
   public function show($permission){   
       return response()->json($this->permissionRepository->show($permission));
   }

   /**
    *Store a newly created resource in storage.
     *
     * @return  \Illuminate\Http\Response
   */
   public function store(Request $request)
     {
       //Save Permissions
       $permission = $this->permissionRepository->store($request);
       $data = [];
       if ($permission) {
           $data['successful'] = true;
           $data['message'] = 'Record Entered Successfully';
           $data['last_insert_id'] = $permission->id;
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
   public function update($permission,Request $request)
     {
       //Update Permissions
       $permission = $this->permissionRepository->update($permission, $request);
       $data = [];
       if ($permission) {
           $data['successful'] = true;
           $data['message'] = 'Record Update Successfully';
           $data['permission_id'] = $permission;
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
   public function destroy($permission)
     {
       //Delete Permissions
       $permission = $this->permissionRepository->destroy($permission);
       $data = [];
       if ($permission) {
           $data['successful'] = true;
           $data['message'] = 'Record Delete Successfully';

       }else{
           $data['successful'] = false;
           $data['message'] = 'Record Not Delete Successfully';
       }
       return response()->json($data);
  }
}