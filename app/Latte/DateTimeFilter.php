<?php

declare(strict_types=1);

namespace App\Latte;

use DateTime;
use DateTimeImmutable;
use Latte\Runtime\Html;

class DateTimeFilter
{
    public function __invoke(DateTime|DateTimeImmutable $dateTime): Html
    {
        return new Html($dateTime->format('d.m.Y').'<br />'.$dateTime->format('H:i'));
    }
}