<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\Routing\RouteRequest\Ev;
use Plaza\Routing\RouteRequest\Geometries;
use Plaza\Routing\RouteRequest\Mode;
use Plaza\Routing\RouteRequest\Overview;
use Plaza\Routing\RouteRequest\TrafficModel;

/**
 * Request body for route calculation. Origin and destination are GeoJSON Point geometries. Supports optional waypoints, alternative routes, turn-by-turn steps, and EV routing parameters.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 * @phpstan-import-type EvShape from \Plaza\Routing\RouteRequest\Ev
 *
 * @phpstan-type RouteRequestShape = array{
 *   destination: PointGeometry|PointGeometryShape,
 *   origin: PointGeometry|PointGeometryShape,
 *   alternatives?: int|null,
 *   annotations?: bool|null,
 *   departAt?: \DateTimeInterface|null,
 *   ev?: null|Ev|EvShape,
 *   exclude?: string|null,
 *   geometries?: null|Geometries|value-of<Geometries>,
 *   mode?: null|Mode|value-of<Mode>,
 *   overview?: null|Overview|value-of<Overview>,
 *   steps?: bool|null,
 *   trafficModel?: null|TrafficModel|value-of<TrafficModel>,
 *   waypoints?: list<PointGeometry|PointGeometryShape>|null,
 * }
 */
final class RouteRequest implements BaseModel
{
    /** @use SdkModel<RouteRequestShape> */
    use SdkModel;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Required]
    public PointGeometry $destination;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Required]
    public PointGeometry $origin;

    /**
     * Number of alternative routes to return (0-3, default 0). When > 0, response is a FeatureCollection of route Features.
     */
    #[Optional]
    public ?int $alternatives;

    /**
     * Include per-edge annotations (speed, duration) on the route (default: false).
     */
    #[Optional]
    public ?bool $annotations;

    /**
     * Departure time for traffic-aware routing (ISO 8601).
     */
    #[Optional('depart_at', nullable: true)]
    public ?\DateTimeInterface $departAt;

    /**
     * Electric vehicle parameters for EV-aware routing.
     */
    #[Optional(nullable: true)]
    public ?Ev $ev;

    /**
     * Comma-separated road types to exclude (e.g. `toll,motorway,ferry`).
     */
    #[Optional(nullable: true)]
    public ?string $exclude;

    /**
     * Geometry encoding format. Default: `geojson`.
     *
     * @var value-of<Geometries>|null $geometries
     */
    #[Optional(enum: Geometries::class)]
    public ?string $geometries;

    /**
     * Travel mode (default: `auto`).
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Level of geometry detail: `full` (all points), `simplified` (Douglas-Peucker), `false` (no geometry). Default: `full`.
     *
     * @var value-of<Overview>|null $overview
     */
    #[Optional(enum: Overview::class)]
    public ?string $overview;

    /**
     * Include turn-by-turn navigation steps (default: false).
     */
    #[Optional]
    public ?bool $steps;

    /**
     * Traffic prediction model (only used when `depart_at` is set).
     *
     * @var value-of<TrafficModel>|null $trafficModel
     */
    #[Optional('traffic_model', enum: TrafficModel::class, nullable: true)]
    public ?string $trafficModel;

    /**
     * Intermediate waypoints to visit in order (maximum 25).
     *
     * @var list<PointGeometry>|null $waypoints
     */
    #[Optional(list: PointGeometry::class, nullable: true)]
    public ?array $waypoints;

    /**
     * `new RouteRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RouteRequest::with(destination: ..., origin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RouteRequest)->withDestination(...)->withOrigin(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PointGeometry|PointGeometryShape $destination
     * @param PointGeometry|PointGeometryShape $origin
     * @param Ev|EvShape|null $ev
     * @param Geometries|value-of<Geometries>|null $geometries
     * @param Mode|value-of<Mode>|null $mode
     * @param Overview|value-of<Overview>|null $overview
     * @param TrafficModel|value-of<TrafficModel>|null $trafficModel
     * @param list<PointGeometry|PointGeometryShape>|null $waypoints
     */
    public static function with(
        PointGeometry|array $destination,
        PointGeometry|array $origin,
        ?int $alternatives = null,
        ?bool $annotations = null,
        ?\DateTimeInterface $departAt = null,
        Ev|array|null $ev = null,
        ?string $exclude = null,
        Geometries|string|null $geometries = null,
        Mode|string|null $mode = null,
        Overview|string|null $overview = null,
        ?bool $steps = null,
        TrafficModel|string|null $trafficModel = null,
        ?array $waypoints = null,
    ): self {
        $self = new self;

        $self['destination'] = $destination;
        $self['origin'] = $origin;

        null !== $alternatives && $self['alternatives'] = $alternatives;
        null !== $annotations && $self['annotations'] = $annotations;
        null !== $departAt && $self['departAt'] = $departAt;
        null !== $ev && $self['ev'] = $ev;
        null !== $exclude && $self['exclude'] = $exclude;
        null !== $geometries && $self['geometries'] = $geometries;
        null !== $mode && $self['mode'] = $mode;
        null !== $overview && $self['overview'] = $overview;
        null !== $steps && $self['steps'] = $steps;
        null !== $trafficModel && $self['trafficModel'] = $trafficModel;
        null !== $waypoints && $self['waypoints'] = $waypoints;

        return $self;
    }

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     *
     * @param PointGeometry|PointGeometryShape $destination
     */
    public function withDestination(PointGeometry|array $destination): self
    {
        $self = clone $this;
        $self['destination'] = $destination;

        return $self;
    }

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     *
     * @param PointGeometry|PointGeometryShape $origin
     */
    public function withOrigin(PointGeometry|array $origin): self
    {
        $self = clone $this;
        $self['origin'] = $origin;

        return $self;
    }

    /**
     * Number of alternative routes to return (0-3, default 0). When > 0, response is a FeatureCollection of route Features.
     */
    public function withAlternatives(int $alternatives): self
    {
        $self = clone $this;
        $self['alternatives'] = $alternatives;

        return $self;
    }

    /**
     * Include per-edge annotations (speed, duration) on the route (default: false).
     */
    public function withAnnotations(bool $annotations): self
    {
        $self = clone $this;
        $self['annotations'] = $annotations;

        return $self;
    }

    /**
     * Departure time for traffic-aware routing (ISO 8601).
     */
    public function withDepartAt(?\DateTimeInterface $departAt): self
    {
        $self = clone $this;
        $self['departAt'] = $departAt;

        return $self;
    }

    /**
     * Electric vehicle parameters for EV-aware routing.
     *
     * @param Ev|EvShape|null $ev
     */
    public function withEv(Ev|array|null $ev): self
    {
        $self = clone $this;
        $self['ev'] = $ev;

        return $self;
    }

    /**
     * Comma-separated road types to exclude (e.g. `toll,motorway,ferry`).
     */
    public function withExclude(?string $exclude): self
    {
        $self = clone $this;
        $self['exclude'] = $exclude;

        return $self;
    }

    /**
     * Geometry encoding format. Default: `geojson`.
     *
     * @param Geometries|value-of<Geometries> $geometries
     */
    public function withGeometries(Geometries|string $geometries): self
    {
        $self = clone $this;
        $self['geometries'] = $geometries;

        return $self;
    }

    /**
     * Travel mode (default: `auto`).
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Level of geometry detail: `full` (all points), `simplified` (Douglas-Peucker), `false` (no geometry). Default: `full`.
     *
     * @param Overview|value-of<Overview> $overview
     */
    public function withOverview(Overview|string $overview): self
    {
        $self = clone $this;
        $self['overview'] = $overview;

        return $self;
    }

    /**
     * Include turn-by-turn navigation steps (default: false).
     */
    public function withSteps(bool $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }

    /**
     * Traffic prediction model (only used when `depart_at` is set).
     *
     * @param TrafficModel|value-of<TrafficModel>|null $trafficModel
     */
    public function withTrafficModel(
        TrafficModel|string|null $trafficModel
    ): self {
        $self = clone $this;
        $self['trafficModel'] = $trafficModel;

        return $self;
    }

    /**
     * Intermediate waypoints to visit in order (maximum 25).
     *
     * @param list<PointGeometry|PointGeometryShape>|null $waypoints
     */
    public function withWaypoints(?array $waypoints): self
    {
        $self = clone $this;
        $self['waypoints'] = $waypoints;

        return $self;
    }
}
