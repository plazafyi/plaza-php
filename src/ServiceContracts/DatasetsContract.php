<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetList;
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
     * @param string $scope Filter by scope: plaza, user. Default shows user's own + plaza datasets.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $scope = null,
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
}
