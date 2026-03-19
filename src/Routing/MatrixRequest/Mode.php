<?php

declare(strict_types=1);

namespace Plaza\Routing\MatrixRequest;

/**
 * Travel mode.
 */
enum Mode: string
{
    case AUTO = 'auto';

    case FOOT = 'foot';

    case BICYCLE = 'bicycle';
}
