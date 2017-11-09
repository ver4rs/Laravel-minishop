<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
		'name', 'description', 'count', 'image1', 'image2', 'image3'
	];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'products';


}
