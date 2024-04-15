<?php

declare(strict_types=1);

namespace App\Enum;

enum AppElementType {
	case Module;
	case Presenter;
	case Component;

	public function czechAccusative(): string
	{
		// 4. pád
		return match($this) {
			self::Module => 'modul',
			self::Presenter => 'presenter',
			self::Component => 'komponentu',
			default => strtolower($this->name)
		};
	}
}