<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
	/**
	 * @var string
	 */
    protected $table = 'order_items';

	/**
	 * @var array
	 */
	protected $fillable = [
		'product_id', 'order_id', 'count',
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class)->withTrashed();
	}
}
