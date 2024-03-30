<?php

declare(strict_types=1);

namespace App\Enum;

enum UserType: string
{
    case Person = 'person';
    case Company = 'company';
}