<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Reverse geocode a coordinate.
 *
 * @see Plaza\Services\GeocodeService::reverse()
 *
 * @phpstan-type GeocodeReverseParamsShape = array{
 *   lat: float,
 *   lng: float,
 *   lang?: string|null,
 *   layer?: string|null,
 *   limit?: int|null,
 *   radius?: int|null,
 * }
 */
final class GeocodeReverseParams implements BaseModel
{
    /** @use SdkModel<GeocodeReverseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Latitude.
     */
    #[Required]
    public float $lat;

    /**
     * Longitude.
     */
    #[Required]
    public float $lng;

    /**
     * Language code for localized names (e.g. en, de, fr).
     */
    #[Optional]
    public ?string $lang;

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
     * Search radius in meters (default 200, max 5000).
     */
    #[Optional]
    public ?int $radius;

    /**
     * `new GeocodeReverseParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeReverseParams::with(lat: ..., lng: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeReverseParams)->withLat(...)->withLng(...)
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
     */
    public static function with(
        float $lat,
        float $lng,
        ?string $lang = null,
        ?string $layer = null,
        ?int $limit = null,
        ?int $radius = null,
    ): self {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;

        null !== $lang && $self['lang'] = $lang;
        null !== $layer && $self['layer'] = $layer;
        null !== $limit && $self['limit'] = $limit;
        null !== $radius && $self['radius'] = $radius;

        return $self;
    }

    /**
     * Latitude.
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Longitude.
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

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
     * Search radius in meters (default 200, max 5000).
     */
    public function withRadius(int $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
