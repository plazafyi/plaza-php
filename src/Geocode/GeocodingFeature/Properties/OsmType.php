<?php

declare(strict_types=1);

namespace Plaza\Geocode\GeocodingFeature\Properties;

/**
 * OSM element type (node, way, relation).
 */
enum OsmType: string
{
    case NODE = 'node';

    case WAY = 'way';

    case RELATION = 'relation';
}
