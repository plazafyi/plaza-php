<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Geocode\GeocodingFeature\Properties;
use Plaza\Geocode\GeocodingFeature\Type;
use Plaza\PlazaClientService\Geometry;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\PlazaClientService\MultiLineStringGeometry;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\MultiPolygonGeometry;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\PlazaClientService\PolygonGeometry;

/**
 * GeoJSON Feature representing a geocoding result. The geometry is always a Point. Properties include the formatted display name, OSM metadata, confidence score, and source type.
 *
 * @phpstan-import-type GeometryVariants from \Plaza\PlazaClientService\Geometry
 * @phpstan-import-type GeometryShape from \Plaza\PlazaClientService\Geometry
 * @phpstan-import-type PropertiesShape from \Plaza\Geocode\GeocodingFeature\Properties
 *
 * @phpstan-type GeocodingFeatureShape = array{
 *   geometry: GeometryShape,
 *   properties: Properties|PropertiesShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class GeocodingFeature implements BaseModel
{
    /** @use SdkModel<GeocodingFeatureShape> */
    use SdkModel;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants $geometry
     */
    #[Required(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $geometry;

    /**
     * Geocoding result properties.
     */
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
     * @param GeometryShape $geometry
     * @param Properties|PropertiesShape $properties
     * @param Type|value-of<Type> $type
     */
    public static function with(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $geometry,
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
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $geometry
     */
    public function withGeometry(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $geometry,
    ): self {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Geocoding result properties.
     *
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
