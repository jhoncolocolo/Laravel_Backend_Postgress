<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 


class PermissionUser extends Model
{ 
 
	protected $table = 'permission_users';
 
	protected $primaryKey = 'id';
 
	protected $fillable = ["permission_id","user_id"];
 
	protected $hidden = ['created_at','updated_at'];

	
  /**
   * @return  mixed
  */
  public function permission(): BelongsTo
  {
      return $this->belongsTo(Permission::class);
  }

  /**
   * @return  mixed
  */
  public function user(): BelongsTo
  {
      return $this->belongsTo(User::class);
  }

 
}