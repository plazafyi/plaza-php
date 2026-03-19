<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\Routing\MatrixResult;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingMatrixParams\Mode;
use Plaza\ServiceContracts\RoutingContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 */
final class RoutingService implements RoutingContract
{
    /**
     * @api
     */
    public RoutingRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RoutingRawService($client);
    }

    /**
     * @api
     *
     * Calculate an isochrone from a point
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param float $time Travel time in seconds (1-7200)
     * @param string $mode Travel mode (auto, foot, bicycle)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function isochrone(
        float $lat,
        float $lng,
        float $time,
        ?string $mode = null,
        RequestOptions|array|null $requestOptions = null,
    ): GeoJsonFeature {
        $params = Util::removeNulls(
            ['lat' => $lat, 'lng' => $lng, 'time' => $time, 'mode' => $mode]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->isochrone(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Calculate a distance matrix between points
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $destinations Destination points (GeoJSON MultiPoint geometry)
     * @param GeoJsonGeometry|GeoJsonGeometryShape $origins Origin points (GeoJSON MultiPoint geometry)
     * @param Mode|value-of<Mode> $mode Travel mode
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function matrix(
        GeoJsonGeometry|array $destinations,
        GeoJsonGeometry|array $origins,
        Mode|string|null $mode = null,
        RequestOptions|array|null $requestOptions = null,
    ): MatrixResult {
        $params = Util::removeNulls(
            ['destinations' => $destinations, 'origins' => $origins, 'mode' => $mode]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->matrix(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Snap a coordinate to the nearest road
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param int $radius Search radius in meters (default 500, max 5000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearest(
        float $lat,
        float $lng,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): NearestResult {
        $params = Util::removeNulls(
            ['lat' => $lat, 'lng' => $lng, 'radius' => $radius]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->nearest(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Calculate a route between two points
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $destination Destination point (GeoJSON Point geometry)
     * @param GeoJsonGeometry|GeoJsonGeometryShape $origin Origin point (GeoJSON Point geometry)
     * @param \Plaza\Routing\RoutingRouteParams\Mode|value-of<\Plaza\Routing\RoutingRouteParams\Mode> $mode
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function route(
        GeoJsonGeometry|array $destination,
        GeoJsonGeometry|array $origin,
        \Plaza\Routing\RoutingRouteParams\Mode|string|null $mode = null,
        RequestOptions|array|null $requestOptions = null,
    ): RouteResult {
        $params = Util::removeNulls(
            ['destination' => $destination, 'origin' => $origin, 'mode' => $mode]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->route(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
