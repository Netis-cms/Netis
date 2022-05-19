<?php

declare(strict_types=1);

namespace App\Modules\Install;

use App\Modules\Install\Control\Account\AccountControl;
use App\Modules\Install\Control\Database\DatabaseControl;
use App\Modules\Install\Control\Tables\TablesControl;
use App\Modules\Install\Control\Website\WebsiteControl;
use Drago\Localization\Translator;
use Drago\Localization\TranslatorAdapter;
use Nette\Application\UI\Presenter;
use Throwable;


/**
 * Installation and configuration application.
 * @property-read InstallTemplate $template
 */
final class InstallPresenter extends Presenter
{
	use TranslatorAdapter;

	public function __construct(
		private Steps $steps,
		private AccountControl $accountControl,
		private DatabaseControl $databaseControl,
		private TablesControl $tablesControl,
		private WebsiteControl $websiteControl,
	) {
		parent::__construct();
	}


	/**
	 * @throws Throwable
	 */
	protected function beforeRender(): void
	{
		parent::beforeRender();
		$step = $this->steps->getStep();
		$this->template->step = $step ?? 0;
	}


	public function getTranslator(): Translator
	{
		$translator = $this->translator;
		$translator->setCustomTranslate(__DIR__ . '/locales/', $this->lang);
		return $translator;
	}


	public function renderDefault(): void
	{
		if ($this->isAjax()) {
			$this->redrawControl('install');
		}
	}


	/**
	 * Run install application.
	 */
	public function handleRun(): void
	{
		$this->steps->setStep(1);
	}


	protected function createComponentAccount(): AccountControl
	{
		return $this->accountControl;
	}


	protected function createComponentDatabase(): DatabaseControl
	{
		return $this->databaseControl;
	}


	protected function createComponentTables(): TablesControl
	{
		return $this->tablesControl;
	}


	protected function createComponentWebsite(): WebsiteControl
	{
		return $this->websiteControl;
	}
}
