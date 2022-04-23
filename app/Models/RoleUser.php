<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 


class RoleUser extends Model
{ 
 
	protected $table = 'role_users';
 
	protected $primaryKey = 'id';
 
	protected $fillable = ["role_id","user_id"];
 
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
  public function user(): BelongsTo
  {
      return $this->belongsTo(User::class);
  }

 
}