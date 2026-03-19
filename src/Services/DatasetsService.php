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
     * @param string $name Dataset name
     * @param string $slug URL-friendly slug
     * @param string|null $attribution Attribution text
     * @param string|null $description Dataset description
     * @param string|null $license License identifier
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
     * @param int $limit Maximum results
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function features(
        string $id,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->features($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
