<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
		'name', 'description', 'count', 'image1', 'image2', 'image3', 'price',
	];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'products';
	
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * Update count of product id
	 * @param $query
	 * @param $productId
	 * @param $number
	 * @param $count
	 * @return mixed
	 */
	public function scopeUpdateCount($query, $productId, $number, $count)
	{
		return $query->where('id', $productId)->update(['count' => $number - $count]);
	}
}
