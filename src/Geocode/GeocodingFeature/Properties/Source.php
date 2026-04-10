<?php

declare(strict_types=1);

namespace Plaza\Geocode\GeocodingFeature\Properties;

/**
 * Result source indicating how the result was found: structured (exact field match), fuzzy (trigram similarity), address (reverse geocode address), place (reverse geocode POI), interpolation (estimated from neighboring addresses).
 */
enum Source: string
{
    case STRUCTURED = 'structured';

    case FUZZY = 'fuzzy';

    case ADDRESS = 'address';

    case PLACE = 'place';

    case INTERPOLATION = 'interpolation';
}
