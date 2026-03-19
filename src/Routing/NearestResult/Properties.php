<?php

declare(strict_types=1);

namespace Plaza\Routing\NearestResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{distanceM?: float|null, edgeID?: int|null}
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Distance to nearest road in meters.
     */
    #[Optional('distance_m')]
    public ?float $distanceM;

    /**
     * Road edge ID.
     */
    #[Optional('edge_id', nullable: true)]
    public ?int $edgeID;

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
        ?float $distanceM = null,
        ?int $edgeID = null
    ): self {
        $self = new self;

        null !== $distanceM && $self['distanceM'] = $distanceM;
        null !== $edgeID && $self['edgeID'] = $edgeID;

        return $self;
    }

    /**
     * Distance to nearest road in meters.
     */
    public function withDistanceM(float $distanceM): self
    {
        $self = clone $this;
        $self['distanceM'] = $distanceM;

        return $self;
    }

    /**
     * Road edge ID.
     */
    public function withEdgeID(?int $edgeID): self
    {
        $self = clone $this;
        $self['edgeID'] = $edgeID;

        return $self;
    }
}
