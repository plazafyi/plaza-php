<?php

declare(strict_types=1);

namespace Plaza\Routing\RouteResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   distance?: float|null, duration?: float|null, mode?: string|null
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
     * Travel mode used.
     */
    #[Optional]
    public ?string $mode;

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
        ?float $distance = null,
        ?float $duration = null,
        ?string $mode = null
    ): self {
        $self = new self;

        null !== $distance && $self['distance'] = $distance;
        null !== $duration && $self['duration'] = $duration;
        null !== $mode && $self['mode'] = $mode;

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
     * Travel mode used.
     */
    public function withMode(string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
