<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService\GeoJsonGeometry;

use Plaza\Core\Concerns\SdkUnion;
use Plaza\Core\Conversion\Contracts\Converter;
use Plaza\Core\Conversion\Contracts\ConverterSource;
use Plaza\Core\Conversion\ListOf;

/**
 * GeoJSON coordinates array (nesting depth varies by geometry type).
 *
 * @phpstan-type CoordinatesVariants = list<float>|list<list<float>>|list<list<list<float>>>|list<list<list<list<float>>>>
 * @phpstan-type CoordinatesShape = CoordinatesVariants
 */
final class Coordinates implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            new ListOf('float'),
            new ListOf(new ListOf('float')),
            new ListOf(new ListOf(new ListOf('float'))),
            new ListOf(new ListOf(new ListOf(new ListOf('float')))),
        ];
    }
}
