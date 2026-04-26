<?php

declare(strict_types=1);

namespace Plaza\Routing\RoutingIsochroneResponse;

/**
 * Always `FeatureCollection`.
 */
enum Type: string
{
    case FEATURE_COLLECTION = 'FeatureCollection';
}
