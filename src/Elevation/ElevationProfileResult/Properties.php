<?php

declare(strict_types=1);

namespace Plaza\Elevation\ElevationProfileResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   avgElevationM?: float|null,
 *   maxElevationM?: float|null,
 *   minElevationM?: float|null,
 *   totalAscentM?: float|null,
 *   totalDescentM?: float|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Average elevation along profile.
     */
    #[Optional('avg_elevation_m')]
    public ?float $avgElevationM;

    /**
     * Maximum elevation along profile.
     */
    #[Optional('max_elevation_m')]
    public ?float $maxElevationM;

    /**
     * Minimum elevation along profile.
     */
    #[Optional('min_elevation_m')]
    public ?float $minElevationM;

    /**
     * Total elevation gain in meters.
     */
    #[Optional('total_ascent_m')]
    public ?float $totalAscentM;

    /**
     * Total elevation loss in meters.
     */
    #[Optional('total_descent_m')]
    public ?float $totalDescentM;

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
        ?float $avgElevationM = null,
        ?float $maxElevationM = null,
        ?float $minElevationM = null,
        ?float $totalAscentM = null,
        ?float $totalDescentM = null,
    ): self {
        $self = new self;

        null !== $avgElevationM && $self['avgElevationM'] = $avgElevationM;
        null !== $maxElevationM && $self['maxElevationM'] = $maxElevationM;
        null !== $minElevationM && $self['minElevationM'] = $minElevationM;
        null !== $totalAscentM && $self['totalAscentM'] = $totalAscentM;
        null !== $totalDescentM && $self['totalDescentM'] = $totalDescentM;

        return $self;
    }

    /**
     * Average elevation along profile.
     */
    public function withAvgElevationM(float $avgElevationM): self
    {
        $self = clone $this;
        $self['avgElevationM'] = $avgElevationM;

        return $self;
    }

    /**
     * Maximum elevation along profile.
     */
    public function withMaxElevationM(float $maxElevationM): self
    {
        $self = clone $this;
        $self['maxElevationM'] = $maxElevationM;

        return $self;
    }

    /**
     * Minimum elevation along profile.
     */
    public function withMinElevationM(float $minElevationM): self
    {
        $self = clone $this;
        $self['minElevationM'] = $minElevationM;

        return $self;
    }

    /**
     * Total elevation gain in meters.
     */
    public function withTotalAscentM(float $totalAscentM): self
    {
        $self = clone $this;
        $self['totalAscentM'] = $totalAscentM;

        return $self;
    }

    /**
     * Total elevation loss in meters.
     */
    public function withTotalDescentM(float $totalDescentM): self
    {
        $self = clone $this;
        $self['totalDescentM'] = $totalDescentM;

        return $self;
    }
}
