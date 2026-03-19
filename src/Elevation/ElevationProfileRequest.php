<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Request body for elevation profile.
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type ElevationProfileRequestShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape
 * }
 */
final class ElevationProfileRequest implements BaseModel
{
    /** @use SdkModel<ElevationProfileRequestShape> */
    use SdkModel;

    /**
     * Path to profile (GeoJSON LineString geometry, minimum 2 points).
     */
    #[Required]
    public GeoJsonGeometry $geometry;

    /**
     * `new ElevationProfileRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationProfileRequest::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationProfileRequest)->withGeometry(...)
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     */
    public static function with(GeoJsonGeometry|array $geometry): self
    {
        $self = new self;

        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Path to profile (GeoJSON LineString geometry, minimum 2 points).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     */
    public function withGeometry(GeoJsonGeometry|array $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }
}
