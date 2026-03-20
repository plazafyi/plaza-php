<?php

declare(strict_types=1);

namespace Plaza\Routing\RouteRequest;

/**
 * Level of geometry detail: `full` (all points), `simplified` (Douglas-Peucker), `false` (no geometry). Default: `full`.
 */
enum Overview: string
{
    case FULL = 'full';

    case SIMPLIFIED = 'simplified';

    case FALSE = 'false';
}
