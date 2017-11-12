<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	/**
	 * @var string
	 */
    protected $table = 'orders';

	/**
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'name', 'city', 'address', 'price', 'status',
	];

	/**
	 * Relationship with user
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Relationship with items
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
