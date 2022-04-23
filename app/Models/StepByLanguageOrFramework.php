<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Notifications\Notifiable; //Import Class


class StepByLanguageOrFramework extends Model
{ 
 	use Notifiable;

	protected $table = 'step_by_language_or_frameworks';
 
	protected $primaryKey = 'id';
  
	protected $fillable = ["language_id","framework_id","step","name","description","photo","ref_urls"];
 
	protected $hidden = ['created_at','updated_at'];
}