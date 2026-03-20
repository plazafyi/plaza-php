<?php

declare(strict_types=1);

namespace Plaza\Routing\RoutingIsochronePostResponse;

/**
 * `Feature` for single contour, `FeatureCollection` for multiple contours.
 */
enum Type: string
{
    case FEATURE = 'Feature';

    case FEATURE_COLLECTION = 'FeatureCollection';
}
