<?php

declare(strict_types=1);

namespace Plaza\MapMatch;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\MapOf;
use Plaza\MapMatch\MapMatchResult\Feature;
use Plaza\MapMatch\MapMatchResult\Type;

/**
 * Map matching result as a GeoJSON FeatureCollection. Each Feature is a snapped tracepoint. The top-level `matchings` array contains the matched sub-routes connecting consecutive tracepoints.
 *
 * @phpstan-import-type FeatureShape from \Plaza\MapMatch\MapMatchResult\Feature
 *
 * @phpstan-type MapMatchResultShape = array{
 *   features: list<Feature|FeatureShape>,
 *   matchings: list<array<string,mixed>>,
 *   type: Type|value-of<Type>,
 * }
 */
final class MapMatchResult implements BaseModel
{
    /** @use SdkModel<MapMatchResultShape> */
    use SdkModel;

    /**
     * Snapped tracepoint Features in input order.
     *
     * @var list<Feature> $features
     */
    #[Required(list: Feature::class)]
    public array $features;

    /**
     * Matched sub-routes. Each matching connects a contiguous sequence of tracepoints that could be matched to roads.
     *
     * @var list<array<string,mixed>> $matchings
     */
    #[Required(list: new MapOf('mixed'))]
    public array $matchings;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new MapMatchResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MapMatchResult::with(features: ..., matchings: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MapMatchResult)->withFeatures(...)->withMatchings(...)->withType(...)
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
     * @param list<array<string,mixed>> $matchings
     * @param Type|value-of<Type> $type
     */
    public static function with(
        array $features,
        array $matchings,
        Type|string $type
    ): self {
        $self = new self;

        $self['features'] = $features;
        $self['matchings'] = $matchings;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Snapped tracepoint Features in input order.
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
     * Matched sub-routes. Each matching connects a contiguous sequence of tracepoints that could be matched to roads.
     *
     * @param list<array<string,mixed>> $matchings
     */
    public function withMatchings(array $matchings): self
    {
        $self = clone $this;
        $self['matchings'] = $matchings;

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
