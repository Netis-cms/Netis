<?php

declare(strict_types=1);

namespace App\Modules\Install\Control\Account;

use App\Modules\Install\Steps;
use App\Services\Entity\UsersEntity;
use Dibi\Connection;
use Dibi\Exception;
use Drago\Application\UI\Alert;
use Drago\Application\UI\ExtraControl;
use Drago\Authorization\Control\Access\UsersRolesEntity;
use Drago\Utils\ExtraArrayHash;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;


/**
 * Add administrator account.
 * @property-read AccountTemplate $template
 */
final class AccountControl extends ExtraControl
{
	public function __construct(
		private Connection $db,
		private Steps $steps,
		private Passwords $password,
	) {
	}


	public function render(): void
	{
		$template = $this->template;
		$template->setFile(__DIR__ . '/Account.latte');
		$template->setTranslator($this->translator);
		$template->form = $this['account'];
		$template->render();
	}


	public function createComponentAccount(): Form
	{
		$form = new Form;
		$form->setTranslator($this->translator);

		$form->addText('username', 'Username')
			->setRequired();

		$form->addText('email', 'Email address')
			->setDefaultValue('@')
			->setHtmlType('email')
			->setRequired()
			->addRule($form::EMAIL);

		$form->addPassword('password', 'Password')
			->setRequired()
			->addRule($form::MIN_LENGTH, null, 6);

		$form->addPassword('verify', 'Password to check')
			->setRequired()
			->addRule($form::EQUAL, 'Passwords do not match.', $form['password']);

		$form->addSubmit('send', 'Register');
		$form->onSuccess[] = [$this, 'success'];
		return $form;
	}


	/**
	 * @throws Exception
	 */
	public function success(Form $form, ExtraArrayHash $data): void
	{
		$data->password = $this->password->hash($data->password);
		$data->offsetUnset('verify');

		// Insert records into the database.
		$this->db->insert(UsersEntity::TABLE, $data->toArray())->execute();
		$this->db->insert(UsersRolesEntity::TABLE, [
			UsersRolesEntity::USER_ID => 1,
			UsersRolesEntity::ROLE_ID => 3,
		])->execute();

		// Save the installation step.
		$this->steps->setStep(5);
		$this->getPresenter()->flashMessage(
			'Account administrator registration successful.', Alert::SUCCESS
		);
	}
}