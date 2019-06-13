<?php

declare(strict_types = 1);

namespace Repository;

use Dibi;
use Drago\Database\Connection;
use Drago\Database\Repository;
use Entity\UserEntity;


/**
 * User repository.
 */
class UserRepository extends Connection
{
	use Repository;

	/** @var string table name */
	private $table = UserEntity::TABLE;


	/**
	 * Find user by email.
	 * @param string $email
	 * @return array|UserEntity|null
	 * @throws Dibi\Exception
	 */
	public function findUser(string $email)
	{
		return $this
			->find(UserEntity::EMAIL, $email)->execute()
			->setRowClass(UserEntity::class)
			->fetch();
	}
}
