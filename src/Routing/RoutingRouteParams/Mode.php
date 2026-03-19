<?php

declare(strict_types=1);

namespace Plaza\Routing\RoutingRouteParams;

enum Mode: string
{
    case AUTO = 'auto';

    case FOOT = 'foot';

    case BICYCLE = 'bicycle';
}
