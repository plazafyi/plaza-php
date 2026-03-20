<?php

declare(strict_types=1);

namespace Plaza\Routing\RouteRequest;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Geographic coordinate as a JSON object with `lat` and `lng` fields.
 *
 * @phpstan-type DestinationShape = array{lat: float, lng: float}
 */
final class Destination implements BaseModel
{
    /** @use SdkModel<DestinationShape> */
    use SdkModel;

    /**
     * Latitude in decimal degrees (-90 to 90).
     */
    #[Required]
    public float $lat;

    /**
     * Longitude in decimal degrees (-180 to 180).
     */
    #[Required]
    public float $lng;

    /**
     * `new Destination()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Destination::with(lat: ..., lng: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Destination)->withLat(...)->withLng(...)
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
    public static function with(float $lat, float $lng): self
    {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Latitude in decimal degrees (-90 to 90).
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Longitude in decimal degrees (-180 to 180).
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }
}
