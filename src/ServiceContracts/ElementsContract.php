<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Elements\ElementBatchParams\Element;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type ElementShape from \Plaza\Elements\ElementBatchParams\Element
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface ElementsContract
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function lookup(
        RequestOptions|array|null $requestOptions = null
    ): GeoJsonFeature;

    /**
     * @api
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
    ): FeatureCollection;

    /**
     * @api
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
    ): FeatureCollection;

    /**
     * @api
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
    ): FeatureCollection;

    /**
     * @api
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
    ): FeatureCollection;
}
