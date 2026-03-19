<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetCreateParams;
use Plaza\Datasets\DatasetFeaturesParams;
use Plaza\Datasets\DatasetList;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\DatasetsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class DatasetsRawService implements DatasetsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new dataset (admin only)
     *
     * @param array{
     *   name: string,
     *   slug: string,
     *   attribution?: string|null,
     *   description?: string|null,
     *   license?: string|null,
     *   sourceURL?: string|null,
     * }|DatasetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Dataset>
     *
     * @throws APIException
     */
    public function create(
        array|DatasetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DatasetCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/datasets',
            body: (object) $parsed,
            options: $options,
            convert: Dataset::class,
        );
    }

    /**
     * @api
     *
     * Get dataset by ID
     *
     * @param string $id Dataset ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Dataset>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/datasets/%1$s', $id],
            options: $requestOptions,
            convert: Dataset::class,
        );
    }

    /**
     * @api
     *
     * List all datasets
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DatasetList>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/datasets',
            options: $requestOptions,
            convert: DatasetList::class,
        );
    }

    /**
     * @api
     *
     * Delete a dataset
     *
     * @param string $id Dataset ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/v1/datasets/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Query features in a dataset
     *
     * @param string $id Dataset ID
     * @param array{cursor?: string, limit?: int}|DatasetFeaturesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function features(
        string $id,
        array|DatasetFeaturesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DatasetFeaturesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/datasets/%1$s/features', $id],
            query: $parsed,
            headers: ['Accept' => 'application/geo+json'],
            options: $options,
            convert: FeatureCollection::class,
        );
    }
}
