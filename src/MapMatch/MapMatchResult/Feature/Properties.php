<?php

declare(strict_types=1);

namespace Plaza\MapMatch\MapMatchResult\Feature;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   distanceM?: float|null,
 *   edgeID?: int|null,
 *   matchingsIndex?: int|null,
 *   name?: string|null,
 *   original?: list<float>|null,
 *   waypointIndex?: int|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Distance from the original GPS point to the snapped point in meters.
     */
    #[Optional('distance_m')]
    public ?float $distanceM;

    /**
     * Road edge ID the point was snapped to.
     */
    #[Optional('edge_id')]
    public ?int $edgeID;

    /**
     * Index into the `matchings` array indicating which matching sub-route this point belongs to.
     */
    #[Optional('matchings_index')]
    public ?int $matchingsIndex;

    /**
     * Road name at the snapped point.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Original GPS coordinate as [lng, lat].
     *
     * @var list<float>|null $original
     */
    #[Optional(list: 'float')]
    public ?array $original;

    /**
     * Index of this tracepoint in the original `coordinates` array.
     */
    #[Optional('waypoint_index')]
    public ?int $waypointIndex;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<float>|null $original
     */
    public static function with(
        ?float $distanceM = null,
        ?int $edgeID = null,
        ?int $matchingsIndex = null,
        ?string $name = null,
        ?array $original = null,
        ?int $waypointIndex = null,
    ): self {
        $self = new self;

        null !== $distanceM && $self['distanceM'] = $distanceM;
        null !== $edgeID && $self['edgeID'] = $edgeID;
        null !== $matchingsIndex && $self['matchingsIndex'] = $matchingsIndex;
        null !== $name && $self['name'] = $name;
        null !== $original && $self['original'] = $original;
        null !== $waypointIndex && $self['waypointIndex'] = $waypointIndex;

        return $self;
    }

    /**
     * Distance from the original GPS point to the snapped point in meters.
     */
    public function withDistanceM(float $distanceM): self
    {
        $self = clone $this;
        $self['distanceM'] = $distanceM;

        return $self;
    }

    /**
     * Road edge ID the point was snapped to.
     */
    public function withEdgeID(int $edgeID): self
    {
        $self = clone $this;
        $self['edgeID'] = $edgeID;

        return $self;
    }

    /**
     * Index into the `matchings` array indicating which matching sub-route this point belongs to.
     */
    public function withMatchingsIndex(int $matchingsIndex): self
    {
        $self = clone $this;
        $self['matchingsIndex'] = $matchingsIndex;

        return $self;
    }

    /**
     * Road name at the snapped point.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Original GPS coordinate as [lng, lat].
     *
     * @param list<float> $original
     */
    public function withOriginal(array $original): self
    {
        $self = clone $this;
        $self['original'] = $original;

        return $self;
    }

    /**
     * Index of this tracepoint in the original `coordinates` array.
     */
    public function withWaypointIndex(int $waypointIndex): self
    {
        $self = clone $this;
        $self['waypointIndex'] = $waypointIndex;

        return $self;
    }
}
