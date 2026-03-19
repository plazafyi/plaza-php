<?php

declare(strict_types=1);

namespace Plaza\Elements\BatchRequest\Element;

enum Type: string
{
    case NODE = 'node';

    case WAY = 'way';

    case RELATION = 'relation';
}
