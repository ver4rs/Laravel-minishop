<?php

namespace App\Repositories\Users;

use App\Repositories\Base\BaseRepository;

class UsersRepository extends BaseRepository
{
	protected $modelClass = \App\User::class;

	public function __construct()
	{
		//
	}
}