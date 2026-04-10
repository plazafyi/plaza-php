<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Request body for nearest-road-segment lookup. Snaps a point to the road network.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type NearestRequestShape = array{
 *   geometry: PointGeometry|PointGeometryShape, radius?: float|null
 * }
 */
final class NearestRequest implements BaseModel
{
    /** @use SdkModel<NearestRequestShape> */
    use SdkModel;

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
     * `new NearestRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NearestRequest::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NearestRequest)->withGeometry(...)
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
