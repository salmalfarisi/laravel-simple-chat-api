<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
	
	protected $fillable = [
        'name', 'stock', 'price', 'image', 'user_id',
    ];
	
	protected $attributes = [
	   'is_delete' => false,
	   'image' => 'null',
	   'user_id' => 0,
	];
}
