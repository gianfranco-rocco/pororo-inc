<?php

declare(strict_types=1);

namespace Domain\Users\Enums;

enum Role: string
{
    case PATIENT = 'patient';
    case CAREGIVER = 'caregiver';
}
