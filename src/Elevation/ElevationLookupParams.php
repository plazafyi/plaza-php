<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Look up elevation at one or more points.
 *
 * @see Plaza\Services\ElevationService::lookup()
 *
 * @phpstan-import-type GeometryVariants from \Plaza\Elevation\ElevationLookupParams\Geometry
 * @phpstan-import-type GeometryShape from \Plaza\Elevation\ElevationLookupParams\Geometry
 *
 * @phpstan-type ElevationLookupParamsShape = array{
 *   geometry: GeometryShape, format?: string|null
 * }
 */
final class ElevationLookupParams implements BaseModel
{
    /** @use SdkModel<ElevationLookupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Point or MultiPoint geometry to look up elevations for.
     *
     * @var GeometryVariants $geometry
     */
    #[Required]
    public PointGeometry|MultiPointGeometry $geometry;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * `new ElevationLookupParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationLookupParams::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationLookupParams)->withGeometry(...)
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
        PointGeometry|array|MultiPointGeometry $geometry,
        ?string $format = null
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;

        null !== $format && $self['format'] = $format;

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

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }
}
