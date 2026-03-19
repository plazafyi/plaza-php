<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Geocode\ReverseGeocodeResult\Type;

/**
 * GeoJSON FeatureCollection of reverse geocoding results.
 *
 * @phpstan-import-type GeocodingFeatureShape from \Plaza\Geocode\GeocodingFeature
 *
 * @phpstan-type ReverseGeocodeResultShape = array{
 *   features: list<GeocodingFeature|GeocodingFeatureShape>,
 *   type: Type|value-of<Type>,
 * }
 */
final class ReverseGeocodeResult implements BaseModel
{
    /** @use SdkModel<ReverseGeocodeResultShape> */
    use SdkModel;

    /** @var list<GeocodingFeature> $features */
    #[Required(list: GeocodingFeature::class)]
    public array $features;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ReverseGeocodeResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReverseGeocodeResult::with(features: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReverseGeocodeResult)->withFeatures(...)->withType(...)
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
