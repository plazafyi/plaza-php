<?php

declare(strict_types=1);

namespace Plaza\Routing\RoutingRouteParams;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Electric vehicle parameters for EV-aware routing.
 *
 * @phpstan-type EvShape = array{
 *   batteryCapacityWh: float,
 *   connectorTypes?: list<string>|null,
 *   initialChargePct?: float|null,
 *   minChargePct?: float|null,
 *   minPowerKw?: float|null,
 * }
 */
final class Ev implements BaseModel
{
    /** @use SdkModel<EvShape> */
    use SdkModel;

    /**
     * Total battery capacity in watt-hours (required for EV routing).
     */
    #[Required('battery_capacity_wh')]
    public float $batteryCapacityWh;

    /**
     * Acceptable connector types (e.g. `["ccs", "chademo"]`).
     *
     * @var list<string>|null $connectorTypes
     */
    #[Optional('connector_types', list: 'string', nullable: true)]
    public ?array $connectorTypes;

    /**
     * Starting charge as a fraction 0-1 (default: 0.8).
     */
    #[Optional('initial_charge_pct')]
    public ?float $initialChargePct;

    /**
     * Minimum acceptable charge at destination as a fraction 0-1 (default: 0.10).
     */
    #[Optional('min_charge_pct')]
    public ?float $minChargePct;

    /**
     * Minimum charger power in kilowatts.
     */
    #[Optional('min_power_kw', nullable: true)]
    public ?float $minPowerKw;

    /**
     * `new Ev()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Ev::with(batteryCapacityWh: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Ev)->withBatteryCapacityWh(...)
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
     * @param list<string>|null $connectorTypes
     */
    public static function with(
        float $batteryCapacityWh,
        ?array $connectorTypes = null,
        ?float $initialChargePct = null,
        ?float $minChargePct = null,
        ?float $minPowerKw = null,
    ): self {
        $self = new self;

        $self['batteryCapacityWh'] = $batteryCapacityWh;

        null !== $connectorTypes && $self['connectorTypes'] = $connectorTypes;
        null !== $initialChargePct && $self['initialChargePct'] = $initialChargePct;
        null !== $minChargePct && $self['minChargePct'] = $minChargePct;
        null !== $minPowerKw && $self['minPowerKw'] = $minPowerKw;

        return $self;
    }

    /**
     * Total battery capacity in watt-hours (required for EV routing).
     */
    public function withBatteryCapacityWh(float $batteryCapacityWh): self
    {
        $self = clone $this;
        $self['batteryCapacityWh'] = $batteryCapacityWh;

        return $self;
    }

    /**
     * Acceptable connector types (e.g. `["ccs", "chademo"]`).
     *
     * @param list<string>|null $connectorTypes
     */
    public function withConnectorTypes(?array $connectorTypes): self
    {
        $self = clone $this;
        $self['connectorTypes'] = $connectorTypes;

        return $self;
    }

    /**
     * Starting charge as a fraction 0-1 (default: 0.8).
     */
    public function withInitialChargePct(float $initialChargePct): self
    {
        $self = clone $this;
        $self['initialChargePct'] = $initialChargePct;

        return $self;
    }

    /**
     * Minimum acceptable charge at destination as a fraction 0-1 (default: 0.10).
     */
    public function withMinChargePct(float $minChargePct): self
    {
        $self = clone $this;
        $self['minChargePct'] = $minChargePct;

        return $self;
    }

    /**
     * Minimum charger power in kilowatts.
     */
    public function withMinPowerKw(?float $minPowerKw): self
    {
        $self = clone $this;
        $self['minPowerKw'] = $minPowerKw;

        return $self;
    }
}
