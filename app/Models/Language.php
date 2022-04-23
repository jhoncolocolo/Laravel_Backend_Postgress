<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Language extends Model
{
    use HasFactory;

	protected $table = 'languages';

	protected $primaryKey = 'id';

	protected $fillable = ["name_en","name_es","meaning_name_en","meaning_name_es"];

	protected $hidden = ['created_at','updated_at'];

}
