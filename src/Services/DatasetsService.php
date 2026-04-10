<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetList;
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
     * Create a new dataset
     *
     * @param string $name Human-readable dataset name
     * @param string $slug URL-friendly identifier (lowercase, hyphens, no spaces)
     * @param string|null $attribution Required attribution text
     * @param string|null $description Dataset description
     * @param string|null $license License identifier (e.g. CC-BY-4.0)
     * @param string|null $sourceURL Source data URL
     * @param bool|null $strictMode Enable strict schema validation (default true)
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
        ?bool $strictMode = null,
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
                'strictMode' => $strictMode,
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
     * List datasets
     *
     * @param string $scope Filter by scope: plaza, user. Default shows user's own + plaza datasets.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $scope = null,
        RequestOptions|array|null $requestOptions = null
    ): DatasetList {
        $params = Util::removeNulls(['scope' => $scope]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

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
}
