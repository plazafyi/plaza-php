<?php

declare(strict_types=1);

namespace Plaza\Elements;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Find features near a geographic point.
 *
 * @see Plaza\Services\ElementsService::nearby()
 *
 * @phpstan-type ElementNearbyParamsShape = array{
 *   lat: float, lng: float, limit?: int|null, radius?: int|null
 * }
 */
final class ElementNearbyParams implements BaseModel
{
    /** @use SdkModel<ElementNearbyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Latitude (-90 to 90).
     */
    #[Required]
    public float $lat;

    /**
     * Longitude (-180 to 180).
     */
    #[Required]
    public float $lng;

    /**
     * Maximum results (default 20, max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Search radius in meters (default 500, max 10000).
     */
    #[Optional]
    public ?int $radius;

    /**
     * `new ElementNearbyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementNearbyParams::with(lat: ..., lng: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementNearbyParams)->withLat(...)->withLng(...)
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
        ?int $limit = null,
        ?int $radius = null
    ): self {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;

        null !== $limit && $self['limit'] = $limit;
        null !== $radius && $self['radius'] = $radius;

        return $self;
    }

    /**
     * Latitude (-90 to 90).
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Longitude (-180 to 180).
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Maximum results (default 20, max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Search radius in meters (default 500, max 10000).
     */
    public function withRadius(int $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
