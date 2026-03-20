<?php

declare(strict_types=1);

namespace Plaza\Routing\RouteRequest;

/**
 * Traffic prediction model (only used when `depart_at` is set).
 */
enum TrafficModel: string
{
    case BEST_GUESS = 'best_guess';

    case OPTIMISTIC = 'optimistic';

    case PESSIMISTIC = 'pessimistic';
}
