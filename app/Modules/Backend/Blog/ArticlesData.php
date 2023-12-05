<?php

declare(strict_types=1);

namespace App\Modules\Backend\Blog;

use Drago\Utils\ExtraArrayHash;


class ArticlesData extends ExtraArrayHash
{
	use ArticlesMapper;
}
