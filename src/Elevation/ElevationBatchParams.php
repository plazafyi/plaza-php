<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Look up elevation for multiple coordinates.
 *
 * @see Plaza\Services\ElevationService::batch()
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type ElevationBatchParamsShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape
 * }
 */
final class ElevationBatchParams implements BaseModel
{
    /** @use SdkModel<ElevationBatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Path to profile (GeoJSON LineString geometry, minimum 2 points).
     */
    #[Required]
    public GeoJsonGeometry $geometry;

    /**
     * `new ElevationBatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationBatchParams::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationBatchParams)->withGeometry(...)
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
