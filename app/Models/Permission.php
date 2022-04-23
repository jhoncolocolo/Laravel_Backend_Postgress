<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
 


class Permission extends Model
{ 
 
	protected $table = 'permissions';
 
	protected $primaryKey = 'id';
 
	protected $fillable = ["id", "name","route",'path',"description"]; //Set id for Seeders inserts or Factories respecting a specific Id, thus avoiding autoincrement
 
	protected $hidden = ['created_at','updated_at'];



  /**
   * @return  mixed
  */
  public function permission_role(): HasMany
  {
      return $this->hasMany(PermissionRole::class);
  }

  /**
   * @return  mixed
  */
  public function permission_user(): HasMany
  {
      return $this->hasMany(PermissionUser::class);
  }

	/**
   * Set the fillable attributes for the model.
   *
   * @param  array  $fillable
   * @return $this
   */
  /*public function fillable_add($attrib)
  {
      array_push($this->fillable,$attrib);
      dd($this->fillable);
      return $this;
  }*/
   
}