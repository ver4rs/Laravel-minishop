<?php

namespace App\Repositories\Orders;


use App\Repositories\Base\BaseRepository;

class OrdersRepository extends BaseRepository
{
	protected $modelClass = \App\Order::class;

	public function __construct()
	{
		//
	}

	/**
	 * Store Item of order
	 * @param $attributes
	 * @return mixed
	 */
	public function saveOrderItem($attributes)
	{
		$this->changeSubModelClass(\App\OrderItem::class);

		return $this->save($attributes);
	}
}