<?php

declare(strict_types=1);

namespace Plaza\Routing\NearestResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Snap result metadata.
 *
 * @phpstan-type PropertiesShape = array{
 *   distanceM?: float|null,
 *   edgeID?: int|null,
 *   edgeLengthM?: float|null,
 *   highway?: string|null,
 *   osmWayID?: int|null,
 *   surface?: string|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Distance from the input coordinate to the snapped point in meters.
     */
    #[Optional('distance_m')]
    public ?float $distanceM;

    /**
     * ID of the road network edge that was snapped to.
     */
    #[Optional('edge_id')]
    public ?int $edgeID;

    /**
     * Length of the matched road edge in meters.
     */
    #[Optional('edge_length_m')]
    public ?float $edgeLengthM;

    /**
     * OSM highway tag value (e.g. `residential`, `primary`, `motorway`).
     */
    #[Optional(nullable: true)]
    public ?string $highway;

    /**
     * OSM way ID of the matched road segment.
     */
    #[Optional('osm_way_id')]
    public ?int $osmWayID;

    /**
     * OSM surface tag value (e.g. `asphalt`, `gravel`, `paved`).
     */
    #[Optional(nullable: true)]
    public ?string $surface;

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
        ?int $edgeID = null,
        ?float $edgeLengthM = null,
        ?string $highway = null,
        ?int $osmWayID = null,
        ?string $surface = null,
    ): self {
        $self = new self;

        null !== $distanceM && $self['distanceM'] = $distanceM;
        null !== $edgeID && $self['edgeID'] = $edgeID;
        null !== $edgeLengthM && $self['edgeLengthM'] = $edgeLengthM;
        null !== $highway && $self['highway'] = $highway;
        null !== $osmWayID && $self['osmWayID'] = $osmWayID;
        null !== $surface && $self['surface'] = $surface;

        return $self;
    }

    /**
     * Distance from the input coordinate to the snapped point in meters.
     */
    public function withDistanceM(float $distanceM): self
    {
        $self = clone $this;
        $self['distanceM'] = $distanceM;

        return $self;
    }

    /**
     * ID of the road network edge that was snapped to.
     */
    public function withEdgeID(int $edgeID): self
    {
        $self = clone $this;
        $self['edgeID'] = $edgeID;

        return $self;
    }

    /**
     * Length of the matched road edge in meters.
     */
    public function withEdgeLengthM(float $edgeLengthM): self
    {
        $self = clone $this;
        $self['edgeLengthM'] = $edgeLengthM;

        return $self;
    }

    /**
     * OSM highway tag value (e.g. `residential`, `primary`, `motorway`).
     */
    public function withHighway(?string $highway): self
    {
        $self = clone $this;
        $self['highway'] = $highway;

        return $self;
    }

    /**
     * OSM way ID of the matched road segment.
     */
    public function withOsmWayID(int $osmWayID): self
    {
        $self = clone $this;
        $self['osmWayID'] = $osmWayID;

        return $self;
    }

    /**
     * OSM surface tag value (e.g. `asphalt`, `gravel`, `paved`).
     */
    public function withSurface(?string $surface): self
    {
        $self = clone $this;
        $self['surface'] = $surface;

        return $self;
    }
}
