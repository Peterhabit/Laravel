<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'uid30',
		'pwd30',
		'name30',
		'tel30',
		'rank30'
	];
}
