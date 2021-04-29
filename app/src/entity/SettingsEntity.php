<?php

/**
 * This file was generated by Drago Generator.
 */

declare(strict_types=1);

namespace App\Entity;

use Drago;
use Nette;

class SettingsEntity extends Drago\Database\Entity
{
	use Nette\SmartObject;

	public const TABLE = 'settings';
	public const NAME = 'name';
	public const VALUE = 'value';

	public string $name;
	public string $value;
}
