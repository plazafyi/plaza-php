<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService\ValidationError\Error;

/**
 * Always `validation_failed`.
 */
enum Code: string
{
    case VALIDATION_FAILED = 'validation_failed';
}
