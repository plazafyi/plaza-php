<?php

declare(strict_types=1);

namespace Plaza\MapMatch;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Match GPS coordinates to the road network.
 *
 * @see Plaza\Services\MapMatchService::match()
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type MapMatchMatchParamsShape = array{
 *   trace: GeoJsonGeometry|GeoJsonGeometryShape, radiuses?: list<float>|null
 * }
 */
final class MapMatchMatchParams implements BaseModel
{
    /** @use SdkModel<MapMatchMatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GPS trace (GeoJSON LineString geometry).
     */
    #[Required]
    public GeoJsonGeometry $trace;

    /**
     * Search radius per coordinate in meters (optional, default 50).
     *
     * @var list<float>|null $radiuses
     */
    #[Optional(list: 'float', nullable: true)]
    public ?array $radiuses;

    /**
     * `new MapMatchMatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MapMatchMatchParams::with(trace: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MapMatchMatchParams)->withTrace(...)
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $trace
     * @param list<float>|null $radiuses
     */
    public static function with(
        GeoJsonGeometry|array $trace,
        ?array $radiuses = null
    ): self {
        $self = new self;

        $self['trace'] = $trace;

        null !== $radiuses && $self['radiuses'] = $radiuses;

        return $self;
    }

    /**
     * GPS trace (GeoJSON LineString geometry).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $trace
     */
    public function withTrace(GeoJsonGeometry|array $trace): self
    {
        $self = clone $this;
        $self['trace'] = $trace;

        return $self;
    }

    /**
     * Search radius per coordinate in meters (optional, default 50).
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
