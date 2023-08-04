<?php

/**
 * This file was generated by Drago Generator.
 */

declare(strict_types=1);

namespace App\Modules\Backend\Sign;

use Drago\Database\Entity;
use Nette\SmartObject;


class UsersEntity extends Entity
{
	use SmartObject;

	public const TABLE = 'users';
	public const PRIMARY = 'id';
	public const USERNAME = 'username';
	public const EMAIL = 'email';
	public const PASSWORD = 'password';
	public const TOKEN = 'token';

	public int $id;
	public string $username;
	public string $email;
	public string $password;
	public string $token;
}
