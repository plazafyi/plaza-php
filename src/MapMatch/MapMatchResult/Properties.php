<?php

declare(strict_types=1);

namespace Plaza\MapMatch\MapMatchResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   confidence?: float|null, distance?: float|null, duration?: float|null
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Match confidence score.
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Total matched distance in meters.
     */
    #[Optional]
    public ?float $distance;

    /**
     * Estimated duration in seconds.
     */
    #[Optional]
    public ?float $duration;

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
        ?float $confidence = null,
        ?float $distance = null,
        ?float $duration = null
    ): self {
        $self = new self;

        null !== $confidence && $self['confidence'] = $confidence;
        null !== $distance && $self['distance'] = $distance;
        null !== $duration && $self['duration'] = $duration;

        return $self;
    }

    /**
     * Match confidence score.
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Total matched distance in meters.
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
}
