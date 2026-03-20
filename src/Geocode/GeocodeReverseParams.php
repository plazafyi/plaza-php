<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Reverse geocode a coordinate.
 *
 * @see Plaza\Services\GeocodeService::reverse()
 *
 * @phpstan-type GeocodeReverseParamsShape = array{
 *   format?: string|null,
 *   lang?: string|null,
 *   lat?: float|null,
 *   layer?: string|null,
 *   limit?: int|null,
 *   lng?: float|null,
 *   near?: string|null,
 *   radius?: int|null,
 * }
 */
final class GeocodeReverseParams implements BaseModel
{
    /** @use SdkModel<GeocodeReverseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * Language code for localized names (e.g. en, de, fr).
     */
    #[Optional]
    public ?string $lang;

    /**
     * Legacy shorthand. Latitude. Use near param instead.
     */
    #[Optional]
    public ?float $lat;

    /**
     * Filter by layer: house or poi.
     */
    #[Optional]
    public ?string $layer;

    /**
     * Maximum results (default 1, max 20).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Legacy shorthand. Longitude. Use near param instead.
     */
    #[Optional]
    public ?float $lng;

    /**
     * Point geometry for reverse geocode (lat,lng or GeoJSON). Alternative to lat/lng params.
     */
    #[Optional]
    public ?string $near;

    /**
     * Search radius in meters (default 200, max 5000).
     */
    #[Optional]
    public ?int $radius;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $format = null,
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        ?string $near = null,
        ?int $radius = null,
    ): self {
        $self = new self;

        null !== $format && $self['format'] = $format;
        null !== $lang && $self['lang'] = $lang;
        null !== $lat && $self['lat'] = $lat;
        null !== $layer && $self['layer'] = $layer;
        null !== $limit && $self['limit'] = $limit;
        null !== $lng && $self['lng'] = $lng;
        null !== $near && $self['near'] = $near;
        null !== $radius && $self['radius'] = $radius;

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
     * Language code for localized names (e.g. en, de, fr).
     */
    public function withLang(string $lang): self
    {
        $self = clone $this;
        $self['lang'] = $lang;

        return $self;
    }

    /**
     * Legacy shorthand. Latitude. Use near param instead.
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Filter by layer: house or poi.
     */
    public function withLayer(string $layer): self
    {
        $self = clone $this;
        $self['layer'] = $layer;

        return $self;
    }

    /**
     * Maximum results (default 1, max 20).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Legacy shorthand. Longitude. Use near param instead.
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Point geometry for reverse geocode (lat,lng or GeoJSON). Alternative to lat/lng params.
     */
    public function withNear(string $near): self
    {
        $self = clone $this;
        $self['near'] = $near;

        return $self;
    }

    /**
     * Search radius in meters (default 200, max 5000).
     */
    public function withRadius(int $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
