<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
 


class Role extends Model
{ 
 
	protected $table = 'roles';
 
	protected $primaryKey = 'id';
 
	protected $fillable = ["id","name","role","description"];//Set id for Seeders inserts or Factories respecting a specific Id, thus avoiding autoincrement
 
	protected $hidden = ['created_at','updated_at'];

  /**
   * @return  mixed
  */
  public function role_user(): HasMany
  {
      return $this->hasMany(RoleUser::class);
  }

  /**
   * @return  mixed
  */
  public function permission_role(): HasMany
  {
      return $this->hasMany(PermissionRole::class);
  }

	
 
}