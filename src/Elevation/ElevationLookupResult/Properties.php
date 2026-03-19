<?php

declare(strict_types=1);

namespace Plaza\Elevation\ElevationLookupResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{elevationM?: float|null}
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Elevation in meters above mean sea level.
     */
    #[Optional('elevation_m')]
    public ?float $elevationM;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $elevationM = null): self
    {
        $self = new self;

        null !== $elevationM && $self['elevationM'] = $elevationM;

        return $self;
    }

    /**
     * Elevation in meters above mean sea level.
     */
    public function withElevationM(float $elevationM): self
    {
        $self = clone $this;
        $self['elevationM'] = $elevationM;

        return $self;
    }
}
