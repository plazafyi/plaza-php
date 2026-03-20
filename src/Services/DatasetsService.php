<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetList;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\DatasetsContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class DatasetsService implements DatasetsContract
{
    /**
     * @api
     */
    public DatasetsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DatasetsRawService($client);
    }

    /**
     * @api
     *
     * Create a new dataset (admin only)
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
    ): Dataset {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'slug' => $slug,
                'attribution' => $attribution,
                'description' => $description,
                'license' => $license,
                'sourceURL' => $sourceURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get dataset by ID
     *
     * @param string $id Dataset ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Dataset {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List all datasets
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): DatasetList {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a dataset
     *
     * @param string $id Dataset ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Query features in a dataset
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
    ): FeatureCollection {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'format' => $format,
                'limit' => $limit,
                'outputBuffer' => $outputBuffer,
                'outputCentroid' => $outputCentroid,
                'outputFields' => $outputFields,
                'outputGeometry' => $outputGeometry,
                'outputInclude' => $outputInclude,
                'outputPrecision' => $outputPrecision,
                'outputSimplify' => $outputSimplify,
                'outputSort' => $outputSort,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->features($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
