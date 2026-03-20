<?php

declare(strict_types=1);

namespace Plaza\Routing\RoutingIsochronePostResponse\Properties;

/**
 * Travel mode used for the isochrone calculation.
 */
enum Mode: string
{
    case AUTO = 'auto';

    case FOOT = 'foot';

    case BICYCLE = 'bicycle';
}
