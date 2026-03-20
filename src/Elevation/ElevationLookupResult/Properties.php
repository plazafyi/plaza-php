<?php

declare(strict_types=1);

namespace Plaza\Elevation\ElevationLookupResult;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{elevationM: float}
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Elevation in meters above mean sea level (WGS84 EGM96 geoid).
     */
    #[Required('elevation_m')]
    public float $elevationM;

    /**
     * `new Properties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Properties::with(elevationM: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Properties)->withElevationM(...)
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
    public static function with(float $elevationM): self
    {
        $self = new self;

        $self['elevationM'] = $elevationM;

        return $self;
    }

    /**
     * Elevation in meters above mean sea level (WGS84 EGM96 geoid).
     */
    public function withElevationM(float $elevationM): self
    {
        $self = clone $this;
        $self['elevationM'] = $elevationM;

        return $self;
    }
}
