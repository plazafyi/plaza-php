<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\RequestOptions;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochronePostResponse;
use Plaza\Routing\RoutingIsochroneResponse;
use Plaza\Routing\RoutingMatrixParams\Mode;
use Plaza\Routing\RoutingRouteParams\Destination;
use Plaza\Routing\RoutingRouteParams\Ev;
use Plaza\Routing\RoutingRouteParams\Geometries;
use Plaza\Routing\RoutingRouteParams\Origin;
use Plaza\Routing\RoutingRouteParams\Overview;
use Plaza\Routing\RoutingRouteParams\TrafficModel;
use Plaza\Routing\RoutingRouteParams\Waypoint;

/**
 * @phpstan-import-type DestinationShape from \Plaza\Routing\RoutingMatrixParams\Destination as DestinationShape1
 * @phpstan-import-type OriginShape from \Plaza\Routing\RoutingMatrixParams\Origin as OriginShape1
 * @phpstan-import-type DestinationShape from \Plaza\Routing\RoutingRouteParams\Destination
 * @phpstan-import-type OriginShape from \Plaza\Routing\RoutingRouteParams\Origin
 * @phpstan-import-type EvShape from \Plaza\Routing\RoutingRouteParams\Ev
 * @phpstan-import-type WaypointShape from \Plaza\Routing\RoutingRouteParams\Waypoint
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface RoutingContract
{
    /**
     * @api
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param float $time Travel time in seconds (1-7200)
     * @param string $format Response format: json (default), geojson, csv, ndjson
     * @param string $mode Travel mode (auto, foot, bicycle)
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function isochrone(
        float $lat,
        float $lng,
        float $time,
        ?string $format = null,
        ?string $mode = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoutingIsochroneResponse;

    /**
     * @api
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param float $time Travel time in seconds (1-7200)
     * @param string $format Response format: json (default), geojson, csv, ndjson
     * @param string $mode Travel mode (auto, foot, bicycle)
     * @param string $outputFields Comma-separated property fields to include
     * @param bool $outputGeometry Include geometry (default true)
     * @param string $outputInclude Extra computed fields: bbox, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param float $outputSimplify Simplify geometry tolerance in meters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function isochronePost(
        float $lat,
        float $lng,
        float $time,
        ?string $format = null,
        ?string $mode = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoutingIsochronePostResponse;

    /**
     * @api
     *
     * @param list<\Plaza\Routing\RoutingMatrixParams\Destination|DestinationShape1> $destinations Array of destination coordinates (max 50)
     * @param list<\Plaza\Routing\RoutingMatrixParams\Origin|OriginShape1> $origins Array of origin coordinates (max 50)
     * @param string $annotations Comma-separated list of annotations to include: `duration` (always included), `distance`. Example: `duration,distance`.
     * @param float|null $fallbackSpeed Fallback speed in km/h for pairs where no route exists. When set, unreachable pairs get estimated values instead of null.
     * @param Mode|value-of<Mode> $mode Travel mode (default: `auto`)
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
        Mode|string $mode = 'auto',
        RequestOptions|array|null $requestOptions = null,
    ): array;

    /**
     * @api
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param string $outputFields Comma-separated property fields to include
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param int $radius Search radius in meters (default 500, max 5000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearest(
        float $lat,
        float $lng,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): NearestResult;

    /**
     * @api
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param string $outputFields Comma-separated property fields to include
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param int $radius Search radius in meters (default 500, max 5000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function nearestPost(
        float $lat,
        float $lng,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): NearestResult;

    /**
     * @api
     *
     * @param Destination|DestinationShape $destination body param: Geographic coordinate as a JSON object with `lat` and `lng` fields
     * @param Origin|OriginShape $origin body param: Geographic coordinate as a JSON object with `lat` and `lng` fields
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
     * @param list<Waypoint|WaypointShape>|null $waypoints Body param: Intermediate waypoints to visit in order (maximum 25)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function route(
        Destination|array $destination,
        Origin|array $origin,
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
    ): RouteResult;
}
