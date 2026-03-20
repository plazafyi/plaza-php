<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeCompletedResult\Feature;
use Plaza\Optimize\OptimizeCompletedResult\Type;

/**
 * Completed optimization result as a GeoJSON FeatureCollection. Each Feature is a waypoint in optimized visit order. Top-level fields provide summary statistics.
 *
 * @phpstan-import-type FeatureShape from \Plaza\Optimize\OptimizeCompletedResult\Feature
 *
 * @phpstan-type OptimizeCompletedResultShape = array{
 *   features: list<Feature|FeatureShape>,
 *   optimization: string,
 *   roundtrip: bool,
 *   totalCostS: float,
 *   type: Type|value-of<Type>,
 * }
 */
final class OptimizeCompletedResult implements BaseModel
{
    /** @use SdkModel<OptimizeCompletedResultShape> */
    use SdkModel;

    /**
     * Waypoints in optimized visit order.
     *
     * @var list<Feature> $features
     */
    #[Required(list: Feature::class)]
    public array $features;

    /**
     * Optimization method used (e.g. `nearest_neighbor`, `2opt`).
     */
    #[Required]
    public string $optimization;

    /**
     * Whether the route returns to the starting waypoint.
     */
    #[Required]
    public bool $roundtrip;

    /**
     * Total travel time for the optimized route in seconds.
     */
    #[Required('total_cost_s')]
    public float $totalCostS;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new OptimizeCompletedResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OptimizeCompletedResult::with(
     *   features: ..., optimization: ..., roundtrip: ..., totalCostS: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OptimizeCompletedResult)
     *   ->withFeatures(...)
     *   ->withOptimization(...)
     *   ->withRoundtrip(...)
     *   ->withTotalCostS(...)
     *   ->withType(...)
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
     * @param list<Feature|FeatureShape> $features
     * @param Type|value-of<Type> $type
     */
    public static function with(
        array $features,
        string $optimization,
        bool $roundtrip,
        float $totalCostS,
        Type|string $type,
    ): self {
        $self = new self;

        $self['features'] = $features;
        $self['optimization'] = $optimization;
        $self['roundtrip'] = $roundtrip;
        $self['totalCostS'] = $totalCostS;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Waypoints in optimized visit order.
     *
     * @param list<Feature|FeatureShape> $features
     */
    public function withFeatures(array $features): self
    {
        $self = clone $this;
        $self['features'] = $features;

        return $self;
    }

    /**
     * Optimization method used (e.g. `nearest_neighbor`, `2opt`).
     */
    public function withOptimization(string $optimization): self
    {
        $self = clone $this;
        $self['optimization'] = $optimization;

        return $self;
    }

    /**
     * Whether the route returns to the starting waypoint.
     */
    public function withRoundtrip(bool $roundtrip): self
    {
        $self = clone $this;
        $self['roundtrip'] = $roundtrip;

        return $self;
    }

    /**
     * Total travel time for the optimized route in seconds.
     */
    public function withTotalCostS(float $totalCostS): self
    {
        $self = clone $this;
        $self['totalCostS'] = $totalCostS;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
