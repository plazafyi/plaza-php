<?php

declare(strict_types=1);

namespace Plaza\Optimize\OptimizeProcessingResult;

/**
 * Always `processing`.
 */
enum Status: string
{
    case PROCESSING = 'processing';
}
