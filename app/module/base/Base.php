<?php

/**
 * Netis, Little CMS
 * Copyright (c) 2015, Zdeněk Papučík
 */
namespace Base;

use Drago;
use Drago\Localization;
use Drago\Directory;
use Drago\Application;

use Base\Repository;
use Nette\Application\UI;

/**
 * The basic for modules.
 */
abstract class BasePresenter extends UI\Presenter
{
	use Drago\Application\UI\Drago;
	use Localization\Locale;
	use Application\UI\Factory;

	/**
	 * @var Repository\Website
	 * @inject
	 */
	public $website;

	/**
	 * @var Directory\Dirs
	 * @inject
	 */
	public $dirs;

	/**
	 * Modules directory.
	 * @return string
	 */
	public function getModuleDir()
	{
		return $this->dirs->getAppDir() . '/module';
	}

	protected function startup()
	{
		parent::startup();

		// Verify the existence of the installation module.
		if (is_dir($this->getModuleDir() . '/install')) {
			$this->redirect(':Install:Install:');
		}
	}

	protected function beforeRender()
	{
		parent::beforeRender();

		// The currently used language.
		$this->template->lang = $this->lang;

		// Website settings.
		$website = (object) $this->website->all();
		$this->template->web  = $website;
	}

	/**
	 * Translator.
	 * @param string $module
	 * @return Localization\Translator
	 */
	public function translator($module)
	{
		$path = $this->getModuleDir() . '/' . $module . '/locale/' . $this->lang . '.ini';
		return $this->createTranslator($path);
	}

}
