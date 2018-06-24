<?php

/**
 * Netis, Little CMS
 * Copyright (c) 2015, Zdeněk Papučík
 */
namespace Module\Install;

use Nette;
use Nette\Application\Routers;

/**
 * Router factory.
 */
class Router
{
	use Nette\StaticClass;

	/**
	 * @param string $locales
	 * @return Nette\Application\IRouter
	 */
	public static function create($locales)
	{
		$router = new Routers\RouteList;
		$router[] = $module = new Routers\RouteList('Install');
		$module[] = new Routers\Route($locales . 'install/', 'Install:default');
		return $router;
	}

}
