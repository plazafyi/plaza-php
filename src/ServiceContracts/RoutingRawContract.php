<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\RequestOptions;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneParams;
use Plaza\Routing\RoutingIsochronePostParams;
use Plaza\Routing\RoutingIsochronePostResponse;
use Plaza\Routing\RoutingIsochroneResponse;
use Plaza\Routing\RoutingMatrixParams;
use Plaza\Routing\RoutingNearestParams;
use Plaza\Routing\RoutingNearestPostParams;
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
     * @return BaseResponse<RoutingIsochroneResponse>
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
     * @param array<string,mixed>|RoutingIsochronePostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingIsochronePostResponse>
     *
     * @throws APIException
     */
    public function isochronePost(
        array|RoutingIsochronePostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RoutingMatrixParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
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
     * @param array<string,mixed>|RoutingNearestPostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NearestResult>
     *
     * @throws APIException
     */
    public function nearestPost(
        array|RoutingNearestPostParams $params,
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
