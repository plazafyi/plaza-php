<?php

declare(strict_types=1);

namespace Plaza\Query\QueryExecuteParams\Step;

/**
 * Step type: `overpass`, `sparql`, `filter`, or `transform`.
 */
enum Type: string
{
    case OVERPASS = 'overpass';

    case SPARQL = 'sparql';

    case FILTER = 'filter';

    case TRANSFORM = 'transform';
}
