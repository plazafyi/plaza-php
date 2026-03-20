<?php

declare(strict_types=1);

namespace Plaza\Routing\RouteResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\ListOf;
use Plaza\Core\Conversion\MapOf;

/**
 * Route metadata.
 *
 * @phpstan-type PropertiesShape = array{
 *   distanceM: float,
 *   durationS: float,
 *   annotations?: array<string,mixed>|null,
 *   chargeProfile?: list<list<float>>|null,
 *   chargingStops?: list<array<string,mixed>>|null,
 *   edges?: list<array<string,mixed>>|null,
 *   energyUsedWh?: float|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Total route distance in meters.
     */
    #[Required('distance_m')]
    public float $distanceM;

    /**
     * Estimated travel duration in seconds.
     */
    #[Required('duration_s')]
    public float $durationS;

    /**
     * Per-edge annotations (present when `annotations: true` in request).
     *
     * @var array<string,mixed>|null $annotations
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $annotations;

    /**
     * Battery charge level at route waypoints as [distance_fraction, charge_pct] pairs (EV routes only).
     *
     * @var list<list<float>>|null $chargeProfile
     */
    #[Optional('charge_profile', list: new ListOf('float'), nullable: true)]
    public ?array $chargeProfile;

    /**
     * Recommended charging stops along the route (EV routes only).
     *
     * @var list<array<string,mixed>>|null $chargingStops
     */
    #[Optional('charging_stops', list: new MapOf('mixed'), nullable: true)]
    public ?array $chargingStops;

    /**
     * Edge-level route details (present when `annotations: true`).
     *
     * @var list<array<string,mixed>>|null $edges
     */
    #[Optional(list: new MapOf('mixed'), nullable: true)]
    public ?array $edges;

    /**
     * Total energy consumed in watt-hours (EV routes only).
     */
    #[Optional('energy_used_wh', nullable: true)]
    public ?float $energyUsedWh;

    /**
     * `new Properties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Properties::with(distanceM: ..., durationS: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Properties)->withDistanceM(...)->withDurationS(...)
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
     *
     * @param array<string,mixed>|null $annotations
     * @param list<list<float>>|null $chargeProfile
     * @param list<array<string,mixed>>|null $chargingStops
     * @param list<array<string,mixed>>|null $edges
     */
    public static function with(
        float $distanceM,
        float $durationS,
        ?array $annotations = null,
        ?array $chargeProfile = null,
        ?array $chargingStops = null,
        ?array $edges = null,
        ?float $energyUsedWh = null,
    ): self {
        $self = new self;

        $self['distanceM'] = $distanceM;
        $self['durationS'] = $durationS;

        null !== $annotations && $self['annotations'] = $annotations;
        null !== $chargeProfile && $self['chargeProfile'] = $chargeProfile;
        null !== $chargingStops && $self['chargingStops'] = $chargingStops;
        null !== $edges && $self['edges'] = $edges;
        null !== $energyUsedWh && $self['energyUsedWh'] = $energyUsedWh;

        return $self;
    }

    /**
     * Total route distance in meters.
     */
    public function withDistanceM(float $distanceM): self
    {
        $self = clone $this;
        $self['distanceM'] = $distanceM;

        return $self;
    }

    /**
     * Estimated travel duration in seconds.
     */
    public function withDurationS(float $durationS): self
    {
        $self = clone $this;
        $self['durationS'] = $durationS;

        return $self;
    }

    /**
     * Per-edge annotations (present when `annotations: true` in request).
     *
     * @param array<string,mixed>|null $annotations
     */
    public function withAnnotations(?array $annotations): self
    {
        $self = clone $this;
        $self['annotations'] = $annotations;

        return $self;
    }

    /**
     * Battery charge level at route waypoints as [distance_fraction, charge_pct] pairs (EV routes only).
     *
     * @param list<list<float>>|null $chargeProfile
     */
    public function withChargeProfile(?array $chargeProfile): self
    {
        $self = clone $this;
        $self['chargeProfile'] = $chargeProfile;

        return $self;
    }

    /**
     * Recommended charging stops along the route (EV routes only).
     *
     * @param list<array<string,mixed>>|null $chargingStops
     */
    public function withChargingStops(?array $chargingStops): self
    {
        $self = clone $this;
        $self['chargingStops'] = $chargingStops;

        return $self;
    }

    /**
     * Edge-level route details (present when `annotations: true`).
     *
     * @param list<array<string,mixed>>|null $edges
     */
    public function withEdges(?array $edges): self
    {
        $self = clone $this;
        $self['edges'] = $edges;

        return $self;
    }

    /**
     * Total energy consumed in watt-hours (EV routes only).
     */
    public function withEnergyUsedWh(?float $energyUsedWh): self
    {
        $self = clone $this;
        $self['energyUsedWh'] = $energyUsedWh;

        return $self;
    }
}
