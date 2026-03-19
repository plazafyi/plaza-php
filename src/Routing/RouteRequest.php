<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\Routing\RouteRequest\Mode;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type RouteRequestShape = array{
 *   destination: GeoJsonGeometry|GeoJsonGeometryShape,
 *   origin: GeoJsonGeometry|GeoJsonGeometryShape,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class RouteRequest implements BaseModel
{
    /** @use SdkModel<RouteRequestShape> */
    use SdkModel;

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
