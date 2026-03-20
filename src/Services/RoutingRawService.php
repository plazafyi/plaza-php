<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Conversion\MapOf;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\RequestOptions;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneParams;
use Plaza\Routing\RoutingIsochronePostParams;
use Plaza\Routing\RoutingIsochronePostResponse;
use Plaza\Routing\RoutingIsochroneResponse;
use Plaza\Routing\RoutingMatrixParams;
use Plaza\Routing\RoutingMatrixParams\Mode;
use Plaza\Routing\RoutingNearestParams;
use Plaza\Routing\RoutingNearestPostParams;
use Plaza\Routing\RoutingRouteParams;
use Plaza\Routing\RoutingRouteParams\Destination;
use Plaza\Routing\RoutingRouteParams\Ev;
use Plaza\Routing\RoutingRouteParams\Geometries;
use Plaza\Routing\RoutingRouteParams\Origin;
use Plaza\Routing\RoutingRouteParams\Overview;
use Plaza\Routing\RoutingRouteParams\TrafficModel;
use Plaza\Routing\RoutingRouteParams\Waypoint;
use Plaza\ServiceContracts\RoutingRawContract;

/**
 * @phpstan-import-type DestinationShape from \Plaza\Routing\RoutingMatrixParams\Destination as DestinationShape1
 * @phpstan-import-type OriginShape from \Plaza\Routing\RoutingMatrixParams\Origin as OriginShape1
 * @phpstan-import-type DestinationShape from \Plaza\Routing\RoutingRouteParams\Destination
 * @phpstan-import-type OriginShape from \Plaza\Routing\RoutingRouteParams\Origin
 * @phpstan-import-type EvShape from \Plaza\Routing\RoutingRouteParams\Ev
 * @phpstan-import-type WaypointShape from \Plaza\Routing\RoutingRouteParams\Waypoint
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
     *   lat: float,
     *   lng: float,
     *   time: float,
     *   format?: string,
     *   mode?: string,
     *   outputFields?: string,
     *   outputGeometry?: bool,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     *   outputSimplify?: float,
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/isochrone',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputGeometry' => 'output[geometry]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                    'outputSimplify' => 'output[simplify]',
                ],
            ),
            options: $options,
            convert: RoutingIsochroneResponse::class,
        );
    }

    /**
     * @api
     *
     * Calculate an isochrone from a point
     *
     * @param array{
     *   lat: float,
     *   lng: float,
     *   time: float,
     *   format?: string,
     *   mode?: string,
     *   outputFields?: string,
     *   outputGeometry?: bool,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     *   outputSimplify?: float,
     * }|RoutingIsochronePostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoutingIsochronePostResponse>
     *
     * @throws APIException
     */
    public function isochronePost(
        array|RoutingIsochronePostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingIsochronePostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/isochrone',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputGeometry' => 'output[geometry]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                    'outputSimplify' => 'output[simplify]',
                ],
            ),
            options: $options,
            convert: RoutingIsochronePostResponse::class,
        );
    }

    /**
     * @api
     *
     * Calculate a distance matrix between points
     *
     * @param array{
     *   destinations: list<RoutingMatrixParams\Destination|DestinationShape1>,
     *   origins: list<RoutingMatrixParams\Origin|OriginShape1>,
     *   annotations?: string,
     *   fallbackSpeed?: float|null,
     *   mode?: Mode|value-of<Mode>,
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
     *   lat: float,
     *   lng: float,
     *   outputFields?: string,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     *   radius?: int,
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
            method: 'get',
            path: 'api/v1/nearest',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                ],
            ),
            options: $options,
            convert: NearestResult::class,
        );
    }

    /**
     * @api
     *
     * Snap a coordinate to the nearest road
     *
     * @param array{
     *   lat: float,
     *   lng: float,
     *   outputFields?: string,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     *   radius?: int,
     * }|RoutingNearestPostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NearestResult>
     *
     * @throws APIException
     */
    public function nearestPost(
        array|RoutingNearestPostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoutingNearestPostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/nearest',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                ],
            ),
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
     *   destination: Destination|DestinationShape,
     *   origin: Origin|OriginShape,
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
     *   waypoints?: list<Waypoint|WaypointShape>|null,
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
