<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	/**
	 * @var string
	 */
    protected $table = 'carts';

	/**
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'token',
	];
	
	/**
	 * All items for this cart
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items()
	{
		return $this->hasMany(CartItem::class, 'cart_id');
	}

	/**
	 * Cart belong to user
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class, 'id');
	}

	/**
	 * Get cart user
	 * @param $query
	 * @param $id
	 * @return mixed
	 */
	public function scopeGetCartUser($query, $id)
	{
		return $query->where('user_id', $id);
	}
}
