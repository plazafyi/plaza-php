<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Snap a coordinate to the nearest road.
 *
 * @see Plaza\Services\RoutingService::nearest()
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type RoutingNearestParamsShape = array{
 *   geometry: PointGeometry|PointGeometryShape, radius?: float|null
 * }
 */
final class RoutingNearestParams implements BaseModel
{
    /** @use SdkModel<RoutingNearestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Required]
    public PointGeometry $geometry;

    /**
     * Maximum search radius in meters (default: 100).
     */
    #[Optional(nullable: true)]
    public ?float $radius;

    /**
     * `new RoutingNearestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingNearestParams::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingNearestParams)->withGeometry(...)
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
     * @param PointGeometry|PointGeometryShape $geometry
     */
    public static function with(
        PointGeometry|array $geometry,
        ?float $radius = null
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;

        null !== $radius && $self['radius'] = $radius;

        return $self;
    }

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     *
     * @param PointGeometry|PointGeometryShape $geometry
     */
    public function withGeometry(PointGeometry|array $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Maximum search radius in meters (default: 100).
     */
    public function withRadius(?float $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
