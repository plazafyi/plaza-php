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
    ): FeatureCollection;
}
