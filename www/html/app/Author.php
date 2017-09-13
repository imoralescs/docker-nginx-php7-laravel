<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $fillable = ['name'];
	
	public function quotes()
    {
    	// Because we have a relationship.
    	return $this->hasMany('App\Quote');
    }
}
