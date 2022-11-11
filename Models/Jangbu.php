<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jangbu extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'io30',
		'writeday30',
		'products_id30',
		'price30',
		'numi30',
		'numo30',
		'prices30',
		'bigo30'

	];
}
