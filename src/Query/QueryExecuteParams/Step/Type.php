<?php

declare(strict_types=1);

namespace Plaza\Query\QueryExecuteParams\Step;

/**
 * Step type: `overpass`, `filter`, or `transform`.
 */
enum Type: string
{
    case OVERPASS = 'overpass';

    case FILTER = 'filter';

    case TRANSFORM = 'transform';
}
