<?php

declare(strict_types=1);

namespace Plaza\Optimize\OptimizeCompletedResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   distance?: float|null, duration?: float|null, waypointOrder?: list<int>|null
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Total distance in meters.
     */
    #[Optional]
    public ?float $distance;

    /**
     * Estimated duration in seconds.
     */
    #[Optional]
    public ?float $duration;

    /**
     * Optimized waypoint ordering.
     *
     * @var list<int>|null $waypointOrder
     */
    #[Optional('waypoint_order', list: 'int')]
    public ?array $waypointOrder;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int>|null $waypointOrder
     */
    public static function with(
        ?float $distance = null,
        ?float $duration = null,
        ?array $waypointOrder = null
    ): self {
        $self = new self;

        null !== $distance && $self['distance'] = $distance;
        null !== $duration && $self['duration'] = $duration;
        null !== $waypointOrder && $self['waypointOrder'] = $waypointOrder;

        return $self;
    }

    /**
     * Total distance in meters.
     */
    public function withDistance(float $distance): self
    {
        $self = clone $this;
        $self['distance'] = $distance;

        return $self;
    }

    /**
     * Estimated duration in seconds.
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Optimized waypoint ordering.
     *
     * @param list<int> $waypointOrder
     */
    public function withWaypointOrder(array $waypointOrder): self
    {
        $self = clone $this;
        $self['waypointOrder'] = $waypointOrder;

        return $self;
    }
}
