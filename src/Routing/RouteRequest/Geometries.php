<?php

declare(strict_types=1);

namespace Plaza\Routing\RouteRequest;

/**
 * Geometry encoding format. Default: `geojson`.
 */
enum Geometries: string
{
    case GEOJSON = 'geojson';

    case POLYLINE = 'polyline';

    case POLYLINE6 = 'polyline6';
}
