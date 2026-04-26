<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Reverse geocode a coordinate.
 *
 * @see Plaza\Services\GeocodeService::reverse()
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type GeocodeReverseParamsShape = array{
 *   geometry: PointGeometry|PointGeometryShape,
 *   format?: string|null,
 *   lang?: string|null,
 *   limit?: int|null,
 *   radius?: float|null,
 * }
 */
final class GeocodeReverseParams implements BaseModel
{
    /** @use SdkModel<GeocodeReverseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Required]
    public PointGeometry $geometry;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * Preferred response language (ISO 639-1).
     */
    #[Optional(nullable: true)]
    public ?string $lang;

    /**
     * Maximum number of results (default: 1, max: 50).
     */
    #[Optional(nullable: true)]
    public ?int $limit;

    /**
     * Search radius in meters (default: 100).
     */
    #[Optional(nullable: true)]
    public ?float $radius;

    /**
     * `new GeocodeReverseParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeReverseParams::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeReverseParams)->withGeometry(...)
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
        ?string $format = null,
        ?string $lang = null,
        ?int $limit = null,
        ?float $radius = null,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;

        null !== $format && $self['format'] = $format;
        null !== $lang && $self['lang'] = $lang;
        null !== $limit && $self['limit'] = $limit;
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
     * Response format: json (default), geojson, csv, ndjson.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Preferred response language (ISO 639-1).
     */
    public function withLang(?string $lang): self
    {
        $self = clone $this;
        $self['lang'] = $lang;

        return $self;
    }

    /**
     * Maximum number of results (default: 1, max: 50).
     */
    public function withLimit(?int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Search radius in meters (default: 100).
     */
    public function withRadius(?float $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
