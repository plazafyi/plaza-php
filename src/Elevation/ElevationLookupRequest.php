<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Request body for elevation lookup. Accepts a single Point or a MultiPoint geometry.
 *
 * @phpstan-import-type GeometryVariants from \Plaza\Elevation\ElevationLookupRequest\Geometry
 * @phpstan-import-type GeometryShape from \Plaza\Elevation\ElevationLookupRequest\Geometry
 *
 * @phpstan-type ElevationLookupRequestShape = array{geometry: GeometryShape}
 */
final class ElevationLookupRequest implements BaseModel
{
    /** @use SdkModel<ElevationLookupRequestShape> */
    use SdkModel;

    /**
     * Point or MultiPoint geometry to look up elevations for.
     *
     * @var GeometryVariants $geometry
     */
    #[Required]
    public PointGeometry|MultiPointGeometry $geometry;

    /**
     * `new ElevationLookupRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationLookupRequest::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationLookupRequest)->withGeometry(...)
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
     * @param GeometryShape $geometry
     */
    public static function with(
        PointGeometry|array|MultiPointGeometry $geometry
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Point or MultiPoint geometry to look up elevations for.
     *
     * @param GeometryShape $geometry
     */
    public function withGeometry(
        PointGeometry|array|MultiPointGeometry $geometry
    ): self {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }
}
