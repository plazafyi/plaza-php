<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\RequestOptions;
use Plaza\Routing\MatrixResult;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneParams;
use Plaza\Routing\RoutingMatrixParams;
use Plaza\Routing\RoutingNearestParams;
use Plaza\Routing\RoutingRouteParams;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface RoutingRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RoutingIsochroneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeoJsonFeature>
     *
     * @throws APIException
     */
    public function isochrone(
        array|RoutingIsochroneParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RoutingMatrixParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MatrixResult>
     *
     * @throws APIException
     */
    public function matrix(
        array|RoutingMatrixParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RoutingNearestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NearestResult>
     *
     * @throws APIException
     */
    public function nearest(
        array|RoutingNearestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RoutingRouteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RouteResult>
     *
     * @throws APIException
     */
    public function route(
        array|RoutingRouteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
