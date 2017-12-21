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
	 * @param int $orderId
	 * @param array $attributes
	 * @return mixed
	 */
	public function saveOrderItem($orderId, $attributes)
	{
		return $this->getById($orderId)->items()->create($attributes);
	}
}
