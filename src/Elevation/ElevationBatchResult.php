<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Elevation\ElevationBatchResult\Type;

/**
 * GeoJSON FeatureCollection of elevation Point Features with 3D coordinates.
 *
 * @phpstan-import-type ElevationLookupResultShape from \Plaza\Elevation\ElevationLookupResult
 *
 * @phpstan-type ElevationBatchResultShape = array{
 *   features: list<ElevationLookupResult|ElevationLookupResultShape>,
 *   type: Type|value-of<Type>,
 * }
 */
final class ElevationBatchResult implements BaseModel
{
    /** @use SdkModel<ElevationBatchResultShape> */
    use SdkModel;

    /**
     * Elevation Point Features for each queried point.
     *
     * @var list<ElevationLookupResult> $features
     */
    #[Required(list: ElevationLookupResult::class)]
    public array $features;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ElevationBatchResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationBatchResult::with(features: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationBatchResult)->withFeatures(...)->withType(...)
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
     * @param list<ElevationLookupResult|ElevationLookupResultShape> $features
     * @param Type|value-of<Type> $type
     */
    public static function with(array $features, Type|string $type): self
    {
        $self = new self;

        $self['features'] = $features;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Elevation Point Features for each queried point.
     *
     * @param list<ElevationLookupResult|ElevationLookupResultShape> $features
     */
    public function withFeatures(array $features): self
    {
        $self = clone $this;
        $self['features'] = $features;

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
