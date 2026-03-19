<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\Routing\MatrixResult;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingMatrixParams\Mode;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 */
interface RoutingContract
{
    /**
     * @api
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
    ): GeoJsonFeature;

    /**
     * @api
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
    ): MatrixResult;

    /**
     * @api
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
    ): NearestResult;

    /**
     * @api
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
    ): RouteResult;
}
