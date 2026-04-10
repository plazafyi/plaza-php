<?php

declare(strict_types=1);

namespace Plaza\MapMatch;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\LineStringGeometry;

/**
 * GPS trace to snap to the road network. Provide a GeoJSON LineString geometry representing the GPS trace.
 *
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
 *
 * @phpstan-type MapMatchRequestShape = array{
 *   geometry: LineStringGeometry|LineStringGeometryShape,
 *   radiuses?: list<float>|null,
 * }
 */
final class MapMatchRequest implements BaseModel
{
    /** @use SdkModel<MapMatchRequestShape> */
    use SdkModel;

    /**
     * GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     */
    #[Required]
    public LineStringGeometry $geometry;

    /**
     * Search radius per coordinate in meters. Must have the same length as the geometry coordinates or be omitted entirely. Default: 50m per point.
     *
     * @var list<float>|null $radiuses
     */
    #[Optional(list: 'float', nullable: true)]
    public ?array $radiuses;

    /**
     * `new MapMatchRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MapMatchRequest::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MapMatchRequest)->withGeometry(...)
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
     * @param LineStringGeometry|LineStringGeometryShape $geometry
     * @param list<float>|null $radiuses
     */
    public static function with(
        LineStringGeometry|array $geometry,
        ?array $radiuses = null
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;

        null !== $radiuses && $self['radiuses'] = $radiuses;

        return $self;
    }

    /**
     * GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     *
     * @param LineStringGeometry|LineStringGeometryShape $geometry
     */
    public function withGeometry(LineStringGeometry|array $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Search radius per coordinate in meters. Must have the same length as the geometry coordinates or be omitted entirely. Default: 50m per point.
     *
     * @param list<float>|null $radiuses
     */
    public function withRadiuses(?array $radiuses): self
    {
        $self = clone $this;
        $self['radiuses'] = $radiuses;

        return $self;
    }
}
