<?php

declare(strict_types=1);

namespace Plaza\Core\Conversion;

use Plaza\Core\Conversion\Concerns\ArrayOf;
use Plaza\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
