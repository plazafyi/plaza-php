<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Geocode\GeocodingFeature\Properties;
use Plaza\Geocode\GeocodingFeature\Type;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type PropertiesShape from \Plaza\Geocode\GeocodingFeature\Properties
 *
 * @phpstan-type GeocodingFeatureShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties: Properties|PropertiesShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class GeocodingFeature implements BaseModel
{
    /** @use SdkModel<GeocodingFeatureShape> */
    use SdkModel;

    #[Required]
    public GeoJsonGeometry $geometry;

    #[Required]
    public Properties $properties;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new GeocodingFeature()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodingFeature::with(geometry: ..., properties: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodingFeature)->withGeometry(...)->withProperties(...)->withType(...)
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     * @param Properties|PropertiesShape $properties
     * @param Type|value-of<Type> $type
     */
    public static function with(
        GeoJsonGeometry|array $geometry,
        Properties|array $properties,
        Type|string $type,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['properties'] = $properties;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     */
    public function withGeometry(GeoJsonGeometry|array $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * @param Properties|PropertiesShape $properties
     */
    public function withProperties(Properties|array $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

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
