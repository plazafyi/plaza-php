<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\Routing\RoutingRouteParams\Mode;

/**
 * Calculate a route between two points.
 *
 * @see Plaza\Services\RoutingService::route()
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type RoutingRouteParamsShape = array{
 *   destination: GeoJsonGeometry|GeoJsonGeometryShape,
 *   origin: GeoJsonGeometry|GeoJsonGeometryShape,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class RoutingRouteParams implements BaseModel
{
    /** @use SdkModel<RoutingRouteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Destination point (GeoJSON Point geometry).
     */
    #[Required]
    public GeoJsonGeometry $destination;

    /**
     * Origin point (GeoJSON Point geometry).
     */
    #[Required]
    public GeoJsonGeometry $origin;

    /** @var value-of<Mode>|null $mode */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * `new RoutingRouteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingRouteParams::with(destination: ..., origin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingRouteParams)->withDestination(...)->withOrigin(...)
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $destination
     * @param GeoJsonGeometry|GeoJsonGeometryShape $origin
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        GeoJsonGeometry|array $destination,
        GeoJsonGeometry|array $origin,
        Mode|string|null $mode = null,
    ): self {
        $self = new self;

        $self['destination'] = $destination;
        $self['origin'] = $origin;

        null !== $mode && $self['mode'] = $mode;

        return $self;
    }

    /**
     * Destination point (GeoJSON Point geometry).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $destination
     */
    public function withDestination(GeoJsonGeometry|array $destination): self
    {
        $self = clone $this;
        $self['destination'] = $destination;

        return $self;
    }

    /**
     * Origin point (GeoJSON Point geometry).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $origin
     */
    public function withOrigin(GeoJsonGeometry|array $origin): self
    {
        $self = clone $this;
        $self['origin'] = $origin;

        return $self;
    }

    /**
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
