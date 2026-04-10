<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\LineStringGeometry;

/**
 * Elevation profile along coordinates.
 *
 * @see Plaza\Services\ElevationService::profile()
 *
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
 *
 * @phpstan-type ElevationProfileParamsShape = array{
 *   geometry: LineStringGeometry|LineStringGeometryShape
 * }
 */
final class ElevationProfileParams implements BaseModel
{
    /** @use SdkModel<ElevationProfileParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     */
    #[Required]
    public LineStringGeometry $geometry;

    /**
     * `new ElevationProfileParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationProfileParams::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationProfileParams)->withGeometry(...)
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
     */
    public static function with(LineStringGeometry|array $geometry): self
    {
        $self = new self;

        $self['geometry'] = $geometry;

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
}
