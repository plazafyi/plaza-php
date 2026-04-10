<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetCreateParams;
use Plaza\Datasets\DatasetList;
use Plaza\Datasets\DatasetListParams;
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
     * @param array<string,mixed>|DatasetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DatasetList>
     *
     * @throws APIException
     */
    public function list(
        array|DatasetListParams $params,
        RequestOptions|array|null $requestOptions = null,
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
}
