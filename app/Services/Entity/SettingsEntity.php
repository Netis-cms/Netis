<?php

/**
 * This file was generated by Drago Generator.
 */

declare(strict_types=1);

namespace App\Services\Entity;

use Drago\Database\Entity;
use Nette\SmartObject;


class SettingsEntity extends Entity
{
	use SmartObject;

	public const TABLE = 'settings';
	public const NAME = 'name';
	public const VALUE = 'value';

	public string $name;
	public string $value;
}
