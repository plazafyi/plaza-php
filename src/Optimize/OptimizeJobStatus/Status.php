<?php

declare(strict_types=1);

namespace Plaza\Optimize\OptimizeJobStatus;

/**
 * Job status.
 */
enum Status: string
{
    case COMPLETED = 'completed';

    case PROCESSING = 'processing';

    case FAILED = 'failed';
}
