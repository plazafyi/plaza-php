<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Geocode\GeocodeResult\Type;

/**
 * GeoJSON FeatureCollection of forward geocoding results, ordered by relevance. Content-Type: `application/geo+json`.
 *
 * @phpstan-import-type GeocodingFeatureShape from \Plaza\Geocode\GeocodingFeature
 *
 * @phpstan-type GeocodeResultShape = array{
 *   features: list<GeocodingFeature|GeocodingFeatureShape>,
 *   type: Type|value-of<Type>,
 * }
 */
final class GeocodeResult implements BaseModel
{
    /** @use SdkModel<GeocodeResultShape> */
    use SdkModel;

    /**
     * Geocoding results ordered by relevance score.
     *
     * @var list<GeocodingFeature> $features
     */
    #[Required(list: GeocodingFeature::class)]
    public array $features;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new GeocodeResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeResult::with(features: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeResult)->withFeatures(...)->withType(...)
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
     * Geocoding results ordered by relevance score.
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
