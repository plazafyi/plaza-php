<?php

declare(strict_types=1);

namespace Plaza\Elevation\ElevationLookupRequest;

use Plaza\Core\Concerns\SdkUnion;
use Plaza\Core\Conversion\Contracts\Converter;
use Plaza\Core\Conversion\Contracts\ConverterSource;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Point or MultiPoint geometry to look up elevations for.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 * @phpstan-import-type MultiPointGeometryShape from \Plaza\PlazaClientService\MultiPointGeometry
 *
 * @phpstan-type GeometryVariants = PointGeometry|MultiPointGeometry
 * @phpstan-type GeometryShape = GeometryVariants|PointGeometryShape|MultiPointGeometryShape
 */
final class Geometry implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [PointGeometry::class, MultiPointGeometry::class];
    }
}
