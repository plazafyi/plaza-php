<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Geometry type.
 */
enum Type: string
{
    case POINT = 'Point';

    case LINE_STRING = 'LineString';

    case POLYGON = 'Polygon';

    case MULTI_POINT = 'MultiPoint';

    case MULTI_LINE_STRING = 'MultiLineString';

    case MULTI_POLYGON = 'MultiPolygon';
}
