<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Concerns\SdkUnion;
use Plaza\Core\Conversion\Contracts\Converter;
use Plaza\Core\Conversion\Contracts\ConverterSource;

/**
 * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
 * @phpstan-import-type PolygonGeometryShape from \Plaza\PlazaClientService\PolygonGeometry
 * @phpstan-import-type MultiPointGeometryShape from \Plaza\PlazaClientService\MultiPointGeometry
 * @phpstan-import-type MultiLineStringGeometryShape from \Plaza\PlazaClientService\MultiLineStringGeometry
 * @phpstan-import-type MultiPolygonGeometryShape from \Plaza\PlazaClientService\MultiPolygonGeometry
 *
 * @phpstan-type GeometryVariants = PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry
 * @phpstan-type GeometryShape = GeometryVariants|PointGeometryShape|LineStringGeometryShape|PolygonGeometryShape|MultiPointGeometryShape|MultiLineStringGeometryShape|MultiPolygonGeometryShape
 */
final class Geometry implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'Point' => PointGeometry::class,
            'LineString' => LineStringGeometry::class,
            'Polygon' => PolygonGeometry::class,
            'MultiPoint' => MultiPointGeometry::class,
            'MultiLineString' => MultiLineStringGeometry::class,
            'MultiPolygon' => MultiPolygonGeometry::class,
        ];
    }
}
