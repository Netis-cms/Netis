<?php

declare(strict_types=1);

namespace App\Services;

use Dibi\Connection;
use Drago\Attr\AttributeDetectionException;
use Drago\Attr\Table;
use Drago\Database\Repository;
use Nette\SmartObject;


#[Table(SettingsEntity::Table)]
class SettingsRepository
{
	use SmartObject;
	use Repository;

	public function __construct(
		protected Connection $db,
	) {
	}


	/**
	 * @throws AttributeDetectionException
	 */
	public function getSettings(): array
	{
		return $this->all()
			->fetchPairs(SettingsEntity::Name, SettingsEntity::Value);
	}
}