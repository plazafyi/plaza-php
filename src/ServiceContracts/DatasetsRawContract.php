<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetCreateParams;
use Plaza\Datasets\DatasetFeaturesParams;
use Plaza\Datasets\DatasetList;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface DatasetsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DatasetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Dataset>
     *
     * @throws APIException
     */
    public function create(
        array|DatasetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DatasetList>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Dataset ID
     * @param array<string,mixed>|DatasetFeaturesParams $params
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
    ): BaseResponse;
}
