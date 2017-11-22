<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
	/**
	 * @var string
	 */
    protected $table = 'carts_item';

	/**
	 * @var array
	 */
	protected $fillable = [
		'cart_id', 'product_id', 'count',
	];

	/**
	 * get total price
	 * @return mixed
	 */
	public function getGetTotalAttribute()
	{
		return $this->count * $this->product->price;
	}

	/**
	 * Relationship with Cart
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cart()
	{
		return $this->belongsTo(Cart::class, 'id');
	}

	/**
	 * Relationship for Info about product
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo(Product::class);
	}

}
