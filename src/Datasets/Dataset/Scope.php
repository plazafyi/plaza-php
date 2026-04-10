<?php

declare(strict_types=1);

namespace Plaza\Datasets\Dataset;

/**
 * Dataset scope: plaza (managed by Plaza) or user (user-owned).
 */
enum Scope: string
{
    case PLAZA = 'plaza';

    case USER = 'user';
}
