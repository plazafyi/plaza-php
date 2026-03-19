<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\Routing\MatrixResult;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneParams;
use Plaza\Routing\RoutingMatrixParams;
use Plaza\Routing\RoutingMatrixParams\Mode;
use Plaza\Routing\RoutingNearestParams;
use Plaza\Routing\RoutingRouteParams;
use Plaza\ServiceContracts\RoutingRawContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 */
final class RoutingRawService implements RoutingRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Calculate an isochrone from a point
     *
     * @param array{
     *   lat: float, lng: float, time: float, mode?: string
     * }|RoutingIsochroneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeoJsonFeature>
     *
     * @throws APIException
     */
    public function isochrone(
        array|RoutingIsochroneParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingIsochroneParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/isochrone',
            query: $parsed,
            headers: ['Accept' => 'application/geo+json'],
            options: $options,
            convert: GeoJsonFeature::class,
        );
    }

    /**
     * @api
     *
     * Calculate a distance matrix between points
     *
     * @param array{
     *   destinations: GeoJsonGeometry|GeoJsonGeometryShape,
     *   origins: GeoJsonGeometry|GeoJsonGeometryShape,
     *   mode?: Mode|value-of<Mode>,
     * }|RoutingMatrixParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MatrixResult>
     *
     * @throws APIException
     */
    public function matrix(
        array|RoutingMatrixParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingMatrixParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/matrix',
            body: (object) $parsed,
            options: $options,
            convert: MatrixResult::class,
        );
    }

    /**
     * @api
     *
     * Snap a coordinate to the nearest road
     *
     * @param array{lat: float, lng: float, radius?: int}|RoutingNearestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NearestResult>
     *
     * @throws APIException
     */
    public function nearest(
        array|RoutingNearestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingNearestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/nearest',
            query: $parsed,
            options: $options,
            convert: NearestResult::class,
        );
    }

    /**
     * @api
     *
     * Calculate a route between two points
     *
     * @param array{
     *   destination: GeoJsonGeometry|GeoJsonGeometryShape,
     *   origin: GeoJsonGeometry|GeoJsonGeometryShape,
     *   mode?: RoutingRouteParams\Mode|value-of<RoutingRouteParams\Mode>,
     * }|RoutingRouteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RouteResult>
     *
     * @throws APIException
     */
    public function route(
        array|RoutingRouteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingRouteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/route',
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
            options: $options,
            convert: RouteResult::class,
        );
    }
}
