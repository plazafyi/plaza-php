<?php

declare(strict_types=1);

namespace Plaza\Optimize\OptimizeJobStatus;

/**
 * Current job state.
 */
enum Status: string
{
    case COMPLETED = 'completed';

    case PROCESSING = 'processing';
}
