<?php

namespace App\Helper\Cart\Fasades;

use Illuminate\Support\Facades\Facade;

class CartLogic extends Facade
{
	protected static function getFacadeAccessor() { return 'cartLogic';     }
}