<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Features\FeatureBatchParams;
use Plaza\Features\FeatureQueryParams;
use Plaza\Features\FeatureRetrieveParams;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface FeaturesRawContract
{
    /**
     * @api
     *
     * @param int $id OSM ID
     * @param array<string,mixed>|FeatureRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeoJsonFeature>
     *
     * @throws APIException
     */
    public function retrieve(
        int $id,
        array|FeatureRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FeatureBatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function batch(
        array|FeatureBatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FeatureQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function query(
        array|FeatureQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
