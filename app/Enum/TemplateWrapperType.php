<?php

declare(strict_types=1);

namespace App\Enum;

enum TemplateWrapperType: string
{
	case Main = 'main';
	case Centered = 'centered';
}