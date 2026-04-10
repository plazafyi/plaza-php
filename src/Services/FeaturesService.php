<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
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
use Plaza\ServiceContracts\FeaturesContract;

/**
 * @phpstan-import-type ElementShape from \Plaza\Features\FeatureBatchParams\Element
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 * @phpstan-import-type GeometryShape from \Plaza\PlazaClientService\Geometry
 */
final class FeaturesService implements FeaturesContract
{
    /**
     * @api
     */
    public FeaturesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FeaturesRawService($client);
    }

    /**
     * @api
     *
     * Get feature by type and ID
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
    ): GeoJsonFeature {
        $params = Util::removeNulls(['type' => $type]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch multiple features by type and ID
     *
     * @param list<Element|ElementShape> $elements Array of element references to fetch
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        array $elements,
        RequestOptions|array|null $requestOptions = null
    ): FeatureCollection {
        $params = Util::removeNulls(['elements' => $elements]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->batch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Query features by spatial predicate, bounding box, or H3 cell
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
    ): FeatureCollection {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'format' => $format,
                'h3' => $h3,
                'limit' => $limit,
                'type' => $type,
                'around' => $around,
                'contains' => $contains,
                'crosses' => $crosses,
                'intersects' => $intersects,
                'notContains' => $notContains,
                'notIntersects' => $notIntersects,
                'notWithin' => $notWithin,
                'radius' => $radius,
                'touches' => $touches,
                'within' => $within,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->query(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
