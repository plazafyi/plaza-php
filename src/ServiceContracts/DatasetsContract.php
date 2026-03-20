<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetList;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface DatasetsContract
{
    /**
     * @api
     *
     * @param string $name Human-readable dataset name
     * @param string $slug URL-friendly identifier (lowercase, hyphens, no spaces)
     * @param string|null $attribution Required attribution text
     * @param string|null $description Dataset description
     * @param string|null $license License identifier (e.g. CC-BY-4.0)
     * @param string|null $sourceURL Source data URL
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        string $slug,
        ?string $attribution = null,
        ?string $description = null,
        ?string $license = null,
        ?string $sourceURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): Dataset;

    /**
     * @api
     *
     * @param string $id Dataset ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Dataset;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): DatasetList;

    /**
     * @api
     *
     * @param string $id Dataset ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Dataset ID
     * @param string $cursor Cursor for pagination
     * @param string $format Response format: json (default), geojson, csv, ndjson
     * @param int $limit Maximum results
     * @param float $outputBuffer Buffer geometry by meters
     * @param bool $outputCentroid Replace geometry with centroid
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param string $outputSort Sort by: distance, name, osm_id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function features(
        string $id,
        ?string $cursor = null,
        ?string $format = null,
        ?int $limit = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection;
}
