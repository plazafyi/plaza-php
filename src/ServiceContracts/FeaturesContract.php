<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Features\FeatureBatchParams\Element;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\PlazaClientService\MultiLineStringGeometry;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\MultiPolygonGeometry;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\PlazaClientService\PolygonGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type ElementShape from \Plaza\Features\FeatureBatchParams\Element
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 * @phpstan-import-type GeometryShape from \Plaza\PlazaClientService\Geometry
 */
interface FeaturesContract
{
    /**
     * @api
     *
     * @param int $id OSM ID
     * @param string $type Element type (node, way, relation)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        int $id,
        string $type,
        RequestOptions|array|null $requestOptions = null
    ): GeoJsonFeature;

    /**
     * @api
     *
     * @param list<Element|ElementShape> $elements Array of element references to fetch
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        array $elements,
        RequestOptions|array|null $requestOptions = null
    ): FeatureCollection;

    /**
     * @api
     *
     * @param string $cursor Query param: Cursor for pagination
     * @param string $format Query param: Response format. json (default) returns paginated GeoJSON. geojson/csv/ndjson stream via chunked transfer encoding.
     * @param string $h3 Query param: Legacy shorthand. H3 cell index. Use spatial predicates instead.
     * @param int $limit Query param: Maximum results (default 100, max 10000)
     * @param string $type Query param: Element types (comma-separated: node,way,relation)
     * @param GeometryShape $around Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $contains Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $crosses Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $intersects Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $notContains Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $notIntersects Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $notWithin Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param float $radius Body param: Search radius in meters. Required for `around`, optional buffer for other predicates.
     * @param GeometryShape $touches Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param GeometryShape $within Body param: GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function query(
        ?string $cursor = null,
        ?string $format = null,
        ?string $h3 = null,
        ?int $limit = null,
        ?string $type = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $around = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $contains = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $crosses = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $intersects = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notContains = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notIntersects = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notWithin = null,
        ?float $radius = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $touches = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $within = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection;
}
