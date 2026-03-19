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
     * @param list<Element|ElementShape> $elements
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
     * @param float $lat Latitude (-90 to 90)
     * @param float $lng Longitude (-180 to 180)
     * @param int $limit Maximum results (default 20, max 100)
     * @param int $radius Search radius in meters (default 500, max 10000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearby(
        float $lat,
        float $lng,
        ?int $limit = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection;

    /**
     * @api
     *
     * @param string $bbox Bounding box: south,west,north,east. At least one of bbox or h3 is required.
     * @param string $cursor Cursor for pagination
     * @param string $h3 H3 cell index. At least one of bbox or h3 is required.
     * @param int $limit Maximum results (default 100, max 10000)
     * @param string $type Element types (comma-separated: node,way,relation)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function query(
        ?string $bbox = null,
        ?string $cursor = null,
        ?string $h3 = null,
        ?int $limit = null,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection;
}
