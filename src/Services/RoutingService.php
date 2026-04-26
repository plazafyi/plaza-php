<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\RequestOptions;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneParams\Mode;
use Plaza\Routing\RoutingIsochroneResponse;
use Plaza\Routing\RoutingRouteParams\Ev;
use Plaza\Routing\RoutingRouteParams\Geometries;
use Plaza\Routing\RoutingRouteParams\Overview;
use Plaza\Routing\RoutingRouteParams\TrafficModel;
use Plaza\ServiceContracts\RoutingContract;

/**
 * @phpstan-import-type EvShape from \Plaza\Routing\RoutingRouteParams\Ev
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
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
     * @param PointGeometry|PointGeometryShape $geometry Body param: GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param list<int> $time Body param: Travel time budgets in seconds. Each value produces one contour polygon.
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param Mode|value-of<Mode> $mode Body param: Travel mode (default: `auto`)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function isochrone(
        PointGeometry|array $geometry,
        array $time,
        ?string $format = null,
        Mode|string $mode = 'auto',
        RequestOptions|array|null $requestOptions = null,
    ): RoutingIsochroneResponse {
        $params = Util::removeNulls(
            [
                'geometry' => $geometry,
                'time' => $time,
                'format' => $format,
                'mode' => $mode,
            ],
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
     * @param list<PointGeometry|PointGeometryShape> $destinations Array of destination coordinates as GeoJSON Points (max 50)
     * @param list<PointGeometry|PointGeometryShape> $origins Array of origin coordinates as GeoJSON Points (max 50)
     * @param string $annotations Comma-separated list of annotations to include: `duration` (always included), `distance`. Example: `duration,distance`.
     * @param float|null $fallbackSpeed Fallback speed in km/h for pairs where no route exists. When set, unreachable pairs get estimated values instead of null.
     * @param \Plaza\Routing\RoutingMatrixParams\Mode|value-of<\Plaza\Routing\RoutingMatrixParams\Mode> $mode Travel mode (default: `auto`)
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function matrix(
        array $destinations,
        array $origins,
        string $annotations = 'duration',
        ?float $fallbackSpeed = null,
        \Plaza\Routing\RoutingMatrixParams\Mode|string $mode = 'auto',
        RequestOptions|array|null $requestOptions = null,
    ): array {
        $params = Util::removeNulls(
            [
                'destinations' => $destinations,
                'origins' => $origins,
                'annotations' => $annotations,
                'fallbackSpeed' => $fallbackSpeed,
                'mode' => $mode,
            ],
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
     * @param PointGeometry|PointGeometryShape $geometry GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param float|null $radius Maximum search radius in meters (default: 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearest(
        PointGeometry|array $geometry,
        ?float $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): NearestResult {
        $params = Util::removeNulls(['geometry' => $geometry, 'radius' => $radius]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->nearest(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Calculate a route between two points
     *
     * @param PointGeometry|PointGeometryShape $destination Body param: GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param PointGeometry|PointGeometryShape $origin Body param: GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param string $format Query param: Response format for alternatives: json (default), geojson, csv, ndjson
     * @param int $alternatives Body param: Number of alternative routes to return (0-3, default 0). When > 0, response is a FeatureCollection of route Features.
     * @param bool $annotations Body param: Include per-edge annotations (speed, duration) on the route (default: false)
     * @param \DateTimeInterface|null $departAt Body param: Departure time for traffic-aware routing (ISO 8601)
     * @param Ev|EvShape|null $ev Body param: Electric vehicle parameters for EV-aware routing
     * @param string|null $exclude Body param: Comma-separated road types to exclude (e.g. `toll,motorway,ferry`)
     * @param Geometries|value-of<Geometries> $geometries Body param: Geometry encoding format. Default: `geojson`.
     * @param \Plaza\Routing\RoutingRouteParams\Mode|value-of<\Plaza\Routing\RoutingRouteParams\Mode> $mode Body param: Travel mode (default: `auto`)
     * @param Overview|value-of<Overview> $overview Body param: Level of geometry detail: `full` (all points), `simplified` (Douglas-Peucker), `false` (no geometry). Default: `full`.
     * @param bool $steps Body param: Include turn-by-turn navigation steps (default: false)
     * @param TrafficModel|value-of<TrafficModel>|null $trafficModel Body param: Traffic prediction model (only used when `depart_at` is set)
     * @param list<PointGeometry|PointGeometryShape>|null $waypoints Body param: Intermediate waypoints to visit in order (maximum 25)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function route(
        PointGeometry|array $destination,
        PointGeometry|array $origin,
        ?string $format = null,
        int $alternatives = 0,
        bool $annotations = false,
        ?\DateTimeInterface $departAt = null,
        Ev|array|null $ev = null,
        ?string $exclude = null,
        Geometries|string $geometries = 'geojson',
        \Plaza\Routing\RoutingRouteParams\Mode|string $mode = 'auto',
        Overview|string $overview = 'full',
        bool $steps = false,
        TrafficModel|string|null $trafficModel = null,
        ?array $waypoints = null,
        RequestOptions|array|null $requestOptions = null,
    ): RouteResult {
        $params = Util::removeNulls(
            [
                'destination' => $destination,
                'origin' => $origin,
                'format' => $format,
                'alternatives' => $alternatives,
                'annotations' => $annotations,
                'departAt' => $departAt,
                'ev' => $ev,
                'exclude' => $exclude,
                'geometries' => $geometries,
                'mode' => $mode,
                'overview' => $overview,
                'steps' => $steps,
                'trafficModel' => $trafficModel,
                'waypoints' => $waypoints,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->route(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
