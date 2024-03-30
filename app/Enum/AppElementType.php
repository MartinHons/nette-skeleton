<?php

declare(strict_types=1);

namespace App\Enum;

enum AppElementType {
	case Module;
	case Presenter;
	case Component;
	case Form;
}