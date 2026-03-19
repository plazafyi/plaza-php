<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Snap a coordinate to the nearest road.
 *
 * @see Plaza\Services\RoutingService::nearest()
 *
 * @phpstan-type RoutingNearestParamsShape = array{
 *   lat: float, lng: float, radius?: int|null
 * }
 */
final class RoutingNearestParams implements BaseModel
{
    /** @use SdkModel<RoutingNearestParamsShape> */
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
     * Search radius in meters (default 500, max 5000).
     */
    #[Optional]
    public ?int $radius;

    /**
     * `new RoutingNearestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingNearestParams::with(lat: ..., lng: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingNearestParams)->withLat(...)->withLng(...)
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
        ?int $radius = null
    ): self {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;

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
     * Search radius in meters (default 500, max 5000).
     */
    public function withRadius(int $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
