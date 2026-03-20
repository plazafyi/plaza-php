<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Elements\ElementBatchParams\Element;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElementsContract;

/**
 * @phpstan-import-type ElementShape from \Plaza\Elements\ElementBatchParams\Element
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class ElementsService implements ElementsContract
{
    /**
     * @api
     */
    public ElementsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ElementsRawService($client);
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
     * Get feature by type and ID
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function lookup(
        RequestOptions|array|null $requestOptions = null
    ): GeoJsonFeature {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->lookup(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Find features near a geographic point
     *
     * @param float $lat Legacy shorthand. Latitude (-90 to 90). Use near param instead.
     * @param int $limit Maximum results (default 20, max 100)
     * @param float $lng Legacy shorthand. Longitude (-180 to 180). Use near param instead.
     * @param string $near Point geometry for proximity search (lat,lng or GeoJSON). Alternative to lat/lng params.
     * @param float $outputBuffer Buffer geometry by meters
     * @param bool $outputCentroid Replace geometry with centroid
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param string $outputSort Sort by: distance, name, osm_id
     * @param int $radius Search radius in meters (default 500, max 10000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearby(
        ?float $lat = null,
        ?int $limit = null,
        ?float $lng = null,
        ?string $near = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(
            [
                'lat' => $lat,
                'limit' => $limit,
                'lng' => $lng,
                'near' => $near,
                'outputBuffer' => $outputBuffer,
                'outputCentroid' => $outputCentroid,
                'outputFields' => $outputFields,
                'outputGeometry' => $outputGeometry,
                'outputInclude' => $outputInclude,
                'outputPrecision' => $outputPrecision,
                'outputSimplify' => $outputSimplify,
                'outputSort' => $outputSort,
                'radius' => $radius,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->nearby(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Find features near a geographic point
     *
     * @param float $lat Legacy shorthand. Latitude (-90 to 90). Use near param instead.
     * @param int $limit Maximum results (default 20, max 100)
     * @param float $lng Legacy shorthand. Longitude (-180 to 180). Use near param instead.
     * @param string $near Point geometry for proximity search (lat,lng or GeoJSON). Alternative to lat/lng params.
     * @param float $outputBuffer Buffer geometry by meters
     * @param bool $outputCentroid Replace geometry with centroid
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param string $outputSort Sort by: distance, name, osm_id
     * @param int $radius Search radius in meters (default 500, max 10000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearbyPost(
        ?float $lat = null,
        ?int $limit = null,
        ?float $lng = null,
        ?string $near = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(
            [
                'lat' => $lat,
                'limit' => $limit,
                'lng' => $lng,
                'near' => $near,
                'outputBuffer' => $outputBuffer,
                'outputCentroid' => $outputCentroid,
                'outputFields' => $outputFields,
                'outputGeometry' => $outputGeometry,
                'outputInclude' => $outputInclude,
                'outputPrecision' => $outputPrecision,
                'outputSimplify' => $outputSimplify,
                'outputSort' => $outputSort,
                'radius' => $radius,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->nearbyPost(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Query features by spatial predicate, bounding box, or H3 cell
     *
     * @param string $bbox Legacy shorthand. Bounding box: south,west,north,east. Use spatial predicates (near, within, intersects) instead.
     * @param string $contains Geometry that features must contain
     * @param string $crosses Geometry that features must cross
     * @param string $cursor Cursor for pagination
     * @param string $format Response format. json (default) returns paginated GeoJSON. geojson/csv/ndjson stream via chunked transfer encoding.
     * @param string $h3 Legacy shorthand. H3 cell index. Use spatial predicates instead.
     * @param string $intersects Geometry that features must intersect
     * @param int $limit Maximum results (default 100, max 10000)
     * @param string $near Point geometry for proximity search (lat,lng). Requires radius.
     * @param float $outputBuffer Buffer geometry by meters
     * @param bool $outputCentroid Replace geometry with centroid
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param string $outputSort Sort by: distance, name, osm_id
     * @param float $radius Search radius in meters (for near) or buffer distance (for other predicates)
     * @param string $touches Geometry that features must touch
     * @param string $type Element types (comma-separated: node,way,relation)
     * @param string $within Geometry that features must be within
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function query(
        ?string $bbox = null,
        ?string $contains = null,
        ?string $crosses = null,
        ?string $cursor = null,
        ?string $format = null,
        ?string $h3 = null,
        ?string $intersects = null,
        ?int $limit = null,
        ?string $near = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        ?float $radius = null,
        ?string $touches = null,
        ?string $type = null,
        ?string $within = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(
            [
                'bbox' => $bbox,
                'contains' => $contains,
                'crosses' => $crosses,
                'cursor' => $cursor,
                'format' => $format,
                'h3' => $h3,
                'intersects' => $intersects,
                'limit' => $limit,
                'near' => $near,
                'outputBuffer' => $outputBuffer,
                'outputCentroid' => $outputCentroid,
                'outputFields' => $outputFields,
                'outputGeometry' => $outputGeometry,
                'outputInclude' => $outputInclude,
                'outputPrecision' => $outputPrecision,
                'outputSimplify' => $outputSimplify,
                'outputSort' => $outputSort,
                'radius' => $radius,
                'touches' => $touches,
                'type' => $type,
                'within' => $within,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->query(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Query features by spatial predicate, bounding box, or H3 cell
     *
     * @param string $bbox Legacy shorthand. Bounding box: south,west,north,east. Use spatial predicates (near, within, intersects) instead.
     * @param string $contains Geometry that features must contain
     * @param string $crosses Geometry that features must cross
     * @param string $cursor Cursor for pagination
     * @param string $format Response format. json (default) returns paginated GeoJSON. geojson/csv/ndjson stream via chunked transfer encoding.
     * @param string $h3 Legacy shorthand. H3 cell index. Use spatial predicates instead.
     * @param string $intersects Geometry that features must intersect
     * @param int $limit Maximum results (default 100, max 10000)
     * @param string $near Point geometry for proximity search (lat,lng). Requires radius.
     * @param float $outputBuffer Buffer geometry by meters
     * @param bool $outputCentroid Replace geometry with centroid
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param string $outputSort Sort by: distance, name, osm_id
     * @param float $radius Search radius in meters (for near) or buffer distance (for other predicates)
     * @param string $touches Geometry that features must touch
     * @param string $type Element types (comma-separated: node,way,relation)
     * @param string $within Geometry that features must be within
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function queryPost(
        ?string $bbox = null,
        ?string $contains = null,
        ?string $crosses = null,
        ?string $cursor = null,
        ?string $format = null,
        ?string $h3 = null,
        ?string $intersects = null,
        ?int $limit = null,
        ?string $near = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        ?float $radius = null,
        ?string $touches = null,
        ?string $type = null,
        ?string $within = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(
            [
                'bbox' => $bbox,
                'contains' => $contains,
                'crosses' => $crosses,
                'cursor' => $cursor,
                'format' => $format,
                'h3' => $h3,
                'intersects' => $intersects,
                'limit' => $limit,
                'near' => $near,
                'outputBuffer' => $outputBuffer,
                'outputCentroid' => $outputCentroid,
                'outputFields' => $outputFields,
                'outputGeometry' => $outputGeometry,
                'outputInclude' => $outputInclude,
                'outputPrecision' => $outputPrecision,
                'outputSimplify' => $outputSimplify,
                'outputSort' => $outputSort,
                'radius' => $radius,
                'touches' => $touches,
                'type' => $type,
                'within' => $within,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->queryPost(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
