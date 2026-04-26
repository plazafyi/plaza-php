<?php

declare(strict_types=1);

namespace Plaza\Features\FeatureBatchParams\Element;

/**
 * OSM element type.
 */
enum Type: string
{
    case NODE = 'node';

    case WAY = 'way';

    case RELATION = 'relation';
}
