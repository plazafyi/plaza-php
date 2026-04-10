<?php

declare(strict_types=1);

namespace Plaza\Datasets\Dataset;

/**
 * Current processing status.
 */
enum Status: string
{
    case PENDING = 'pending';

    case PROCESSING = 'processing';

    case READY = 'ready';

    case ERROR = 'error';
}
