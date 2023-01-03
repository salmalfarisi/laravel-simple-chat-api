<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cruds extends Model
{
    protected $table = 'cruds';
	
	protected $fillable = [
        'title', 'description', 'file',
    ];
	
	protected $attributes = [
	   'is_deleted' => false,
	];
}
