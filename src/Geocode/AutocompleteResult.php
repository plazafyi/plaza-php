<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Geocode\AutocompleteResult\Type;

/**
 * GeoJSON FeatureCollection of autocomplete suggestions for partial address input. Optimized for low-latency type-ahead UIs. Content-Type: `application/geo+json`.
 *
 * @phpstan-import-type GeocodingFeatureShape from \Plaza\Geocode\GeocodingFeature
 *
 * @phpstan-type AutocompleteResultShape = array{
 *   features: list<GeocodingFeature|GeocodingFeatureShape>,
 *   type: Type|value-of<Type>,
 * }
 */
final class AutocompleteResult implements BaseModel
{
    /** @use SdkModel<AutocompleteResultShape> */
    use SdkModel;

    /**
     * Autocomplete suggestions ordered by relevance.
     *
     * @var list<GeocodingFeature> $features
     */
    #[Required(list: GeocodingFeature::class)]
    public array $features;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new AutocompleteResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutocompleteResult::with(features: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutocompleteResult)->withFeatures(...)->withType(...)
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
     * @param list<GeocodingFeature|GeocodingFeatureShape> $features
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
     * Autocomplete suggestions ordered by relevance.
     *
     * @param list<GeocodingFeature|GeocodingFeatureShape> $features
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
