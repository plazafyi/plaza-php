<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Calculate an isochrone from a point.
 *
 * @see Plaza\Services\RoutingService::isochrone()
 *
 * @phpstan-type RoutingIsochroneParamsShape = array{
 *   lat: float, lng: float, time: float, mode?: string|null
 * }
 */
final class RoutingIsochroneParams implements BaseModel
{
    /** @use SdkModel<RoutingIsochroneParamsShape> */
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
     * Travel time in seconds (1-7200).
     */
    #[Required]
    public float $time;

    /**
     * Travel mode (auto, foot, bicycle).
     */
    #[Optional]
    public ?string $mode;

    /**
     * `new RoutingIsochroneParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingIsochroneParams::with(lat: ..., lng: ..., time: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingIsochroneParams)->withLat(...)->withLng(...)->withTime(...)
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
        float $time,
        ?string $mode = null
    ): self {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;
        $self['time'] = $time;

        null !== $mode && $self['mode'] = $mode;

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
     * Travel time in seconds (1-7200).
     */
    public function withTime(float $time): self
    {
        $self = clone $this;
        $self['time'] = $time;

        return $self;
    }

    /**
     * Travel mode (auto, foot, bicycle).
     */
    public function withMode(string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
