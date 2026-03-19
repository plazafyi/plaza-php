<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Look up elevation at one or more points.
 *
 * @see Plaza\Services\ElevationService::lookup()
 *
 * @phpstan-type ElevationLookupParamsShape = array{
 *   lat?: float|null, lng?: float|null, locations?: string|null
 * }
 */
final class ElevationLookupParams implements BaseModel
{
    /** @use SdkModel<ElevationLookupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Latitude (single point).
     */
    #[Optional]
    public ?float $lat;

    /**
     * Longitude (single point).
     */
    #[Optional]
    public ?float $lng;

    /**
     * Pipe-separated lng,lat pairs (batch).
     */
    #[Optional]
    public ?string $locations;

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
        ?float $lat = null,
        ?float $lng = null,
        ?string $locations = null
    ): self {
        $self = new self;

        null !== $lat && $self['lat'] = $lat;
        null !== $lng && $self['lng'] = $lng;
        null !== $locations && $self['locations'] = $locations;

        return $self;
    }

    /**
     * Latitude (single point).
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Longitude (single point).
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Pipe-separated lng,lat pairs (batch).
     */
    public function withLocations(string $locations): self
    {
        $self = clone $this;
        $self['locations'] = $locations;

        return $self;
    }
}
