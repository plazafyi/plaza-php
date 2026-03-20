<?php

declare(strict_types=1);

namespace Plaza\Elevation\ElevationProfileResult;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Elevation profile summary statistics.
 *
 * @phpstan-type PropertiesShape = array{
 *   avgElevationM: float,
 *   maxElevationM: float,
 *   minElevationM: float,
 *   totalAscentM: float,
 *   totalDescentM: float,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Average elevation along the profile in meters.
     */
    #[Required('avg_elevation_m')]
    public float $avgElevationM;

    /**
     * Maximum elevation along the profile in meters.
     */
    #[Required('max_elevation_m')]
    public float $maxElevationM;

    /**
     * Minimum elevation along the profile in meters.
     */
    #[Required('min_elevation_m')]
    public float $minElevationM;

    /**
     * Total cumulative elevation gain in meters.
     */
    #[Required('total_ascent_m')]
    public float $totalAscentM;

    /**
     * Total cumulative elevation loss in meters.
     */
    #[Required('total_descent_m')]
    public float $totalDescentM;

    /**
     * `new Properties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Properties::with(
     *   avgElevationM: ...,
     *   maxElevationM: ...,
     *   minElevationM: ...,
     *   totalAscentM: ...,
     *   totalDescentM: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Properties)
     *   ->withAvgElevationM(...)
     *   ->withMaxElevationM(...)
     *   ->withMinElevationM(...)
     *   ->withTotalAscentM(...)
     *   ->withTotalDescentM(...)
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
        float $avgElevationM,
        float $maxElevationM,
        float $minElevationM,
        float $totalAscentM,
        float $totalDescentM,
    ): self {
        $self = new self;

        $self['avgElevationM'] = $avgElevationM;
        $self['maxElevationM'] = $maxElevationM;
        $self['minElevationM'] = $minElevationM;
        $self['totalAscentM'] = $totalAscentM;
        $self['totalDescentM'] = $totalDescentM;

        return $self;
    }

    /**
     * Average elevation along the profile in meters.
     */
    public function withAvgElevationM(float $avgElevationM): self
    {
        $self = clone $this;
        $self['avgElevationM'] = $avgElevationM;

        return $self;
    }

    /**
     * Maximum elevation along the profile in meters.
     */
    public function withMaxElevationM(float $maxElevationM): self
    {
        $self = clone $this;
        $self['maxElevationM'] = $maxElevationM;

        return $self;
    }

    /**
     * Minimum elevation along the profile in meters.
     */
    public function withMinElevationM(float $minElevationM): self
    {
        $self = clone $this;
        $self['minElevationM'] = $minElevationM;

        return $self;
    }

    /**
     * Total cumulative elevation gain in meters.
     */
    public function withTotalAscentM(float $totalAscentM): self
    {
        $self = clone $this;
        $self['totalAscentM'] = $totalAscentM;

        return $self;
    }

    /**
     * Total cumulative elevation loss in meters.
     */
    public function withTotalDescentM(float $totalDescentM): self
    {
        $self = clone $this;
        $self['totalDescentM'] = $totalDescentM;

        return $self;
    }
}
