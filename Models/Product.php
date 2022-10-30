<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'gubuns_id30',
		'name30',
		'price30',
		'jaego30',
		'pic30'
	];
}
