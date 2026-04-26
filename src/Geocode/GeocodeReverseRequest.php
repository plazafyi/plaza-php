<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Request body for reverse geocoding. Converts coordinates to addresses or place names.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type GeocodeReverseRequestShape = array{
 *   geometry: PointGeometry|PointGeometryShape,
 *   lang?: string|null,
 *   limit?: int|null,
 *   radius?: float|null,
 * }
 */
final class GeocodeReverseRequest implements BaseModel
{
    /** @use SdkModel<GeocodeReverseRequestShape> */
    use SdkModel;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Required]
    public PointGeometry $geometry;

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
     * `new GeocodeReverseRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeReverseRequest::with(geometry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeReverseRequest)->withGeometry(...)
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
        ?string $lang = null,
        ?int $limit = null,
        ?float $radius = null,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;

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
