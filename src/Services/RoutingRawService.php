<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Conversion\MapOf;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\RequestOptions;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneParams;
use Plaza\Routing\RoutingIsochroneParams\Mode;
use Plaza\Routing\RoutingIsochroneResponse;
use Plaza\Routing\RoutingMatrixParams;
use Plaza\Routing\RoutingNearestParams;
use Plaza\Routing\RoutingRouteParams;
use Plaza\Routing\RoutingRouteParams\Ev;
use Plaza\Routing\RoutingRouteParams\Geometries;
use Plaza\Routing\RoutingRouteParams\Overview;
use Plaza\Routing\RoutingRouteParams\TrafficModel;
use Plaza\ServiceContracts\RoutingRawContract;

/**
 * @phpstan-import-type EvShape from \Plaza\Routing\RoutingRouteParams\Ev
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
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
     *   geometry: PointGeometry|PointGeometryShape,
     *   time: list<int>,
     *   format?: string,
     *   mode?: Mode|value-of<Mode>,
     * }|RoutingIsochroneParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingIsochroneResponse>
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
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/isochrone',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: RoutingIsochroneResponse::class,
        );
    }

    /**
     * @api
     *
     * Calculate a distance matrix between points
     *
     * @param array{
     *   destinations: list<PointGeometry|PointGeometryShape>,
     *   origins: list<PointGeometry|PointGeometryShape>,
     *   annotations?: string,
     *   fallbackSpeed?: float|null,
     *   mode?: RoutingMatrixParams\Mode|value-of<RoutingMatrixParams\Mode>,
     * }|RoutingMatrixParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
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
            convert: new MapOf('mixed'),
        );
    }

    /**
     * @api
     *
     * Snap a coordinate to the nearest road
     *
     * @param array{
     *   geometry: PointGeometry|PointGeometryShape, radius?: float|null
     * }|RoutingNearestParams $params
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
            method: 'post',
            path: 'api/v1/nearest',
            body: (object) $parsed,
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
     *   destination: PointGeometry|PointGeometryShape,
     *   origin: PointGeometry|PointGeometryShape,
     *   format?: string,
     *   alternatives?: int,
     *   annotations?: bool,
     *   departAt?: \DateTimeInterface|null,
     *   ev?: Ev|EvShape|null,
     *   exclude?: string|null,
     *   geometries?: Geometries|value-of<Geometries>,
     *   mode?: RoutingRouteParams\Mode|value-of<RoutingRouteParams\Mode>,
     *   overview?: Overview|value-of<Overview>,
     *   steps?: bool,
     *   trafficModel?: TrafficModel|value-of<TrafficModel>|null,
     *   waypoints?: list<PointGeometry|PointGeometryShape>|null,
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
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/route',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: RouteResult::class,
        );
    }
}
