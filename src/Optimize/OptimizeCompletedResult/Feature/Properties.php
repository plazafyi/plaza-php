<?php

declare(strict_types=1);

namespace Plaza\Optimize\OptimizeCompletedResult\Feature;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   costS: float, cumulativeCostS: float, waypointIndex: int
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Travel time in seconds from the previous waypoint to this one (0 for the first waypoint).
     */
    #[Required('cost_s')]
    public float $costS;

    /**
     * Cumulative travel time in seconds from the start to this waypoint.
     */
    #[Required('cumulative_cost_s')]
    public float $cumulativeCostS;

    /**
     * Position of this waypoint in the optimized visit order (0-based).
     */
    #[Required('waypoint_index')]
    public int $waypointIndex;

    /**
     * `new Properties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Properties::with(costS: ..., cumulativeCostS: ..., waypointIndex: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Properties)
     *   ->withCostS(...)
     *   ->withCumulativeCostS(...)
     *   ->withWaypointIndex(...)
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
        float $costS,
        float $cumulativeCostS,
        int $waypointIndex
    ): self {
        $self = new self;

        $self['costS'] = $costS;
        $self['cumulativeCostS'] = $cumulativeCostS;
        $self['waypointIndex'] = $waypointIndex;

        return $self;
    }

    /**
     * Travel time in seconds from the previous waypoint to this one (0 for the first waypoint).
     */
    public function withCostS(float $costS): self
    {
        $self = clone $this;
        $self['costS'] = $costS;

        return $self;
    }

    /**
     * Cumulative travel time in seconds from the start to this waypoint.
     */
    public function withCumulativeCostS(float $cumulativeCostS): self
    {
        $self = clone $this;
        $self['cumulativeCostS'] = $cumulativeCostS;

        return $self;
    }

    /**
     * Position of this waypoint in the optimized visit order (0-based).
     */
    public function withWaypointIndex(int $waypointIndex): self
    {
        $self = clone $this;
        $self['waypointIndex'] = $waypointIndex;

        return $self;
    }
}
