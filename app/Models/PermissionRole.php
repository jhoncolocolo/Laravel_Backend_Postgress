<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 


class PermissionRole extends Model
{ 
 
	protected $table = 'permission_roles';
 
	protected $primaryKey = 'id';
 
	protected $fillable = ["role_id","permission_id"];
 
	protected $hidden = ['created_at','updated_at'];

	
  /**
   * @return  mixed
  */
  public function role(): BelongsTo
  {
      return $this->belongsTo(Role::class);
  }

  /**
   * @return  mixed
  */
  public function permission(): BelongsTo
  {
      return $this->belongsTo(Permission::class);
  }

 
}