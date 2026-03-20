<?php

declare(strict_types=1);

namespace Plaza\MapMatch\MapMatchResult;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\MapMatch\MapMatchResult\Feature\Properties;
use Plaza\MapMatch\MapMatchResult\Feature\Type;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * GeoJSON Point Feature representing a GPS point snapped to the road network.
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type PropertiesShape from \Plaza\MapMatch\MapMatchResult\Feature\Properties
 *
 * @phpstan-type FeatureShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties: Properties|PropertiesShape,
 *   type: \Plaza\MapMatch\MapMatchResult\Feature\Type|value-of<\Plaza\MapMatch\MapMatchResult\Feature\Type>,
 * }
 */
final class Feature implements BaseModel
{
    /** @use SdkModel<FeatureShape> */
    use SdkModel;

    /**
     * GeoJSON Geometry object per RFC 7946. Coordinates use [longitude, latitude] order. 3D coordinates [lng, lat, elevation] are used for elevation endpoints.
     */
    #[Required]
    public GeoJsonGeometry $geometry;

    #[Required]
    public Properties $properties;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Feature()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Feature::with(geometry: ..., properties: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Feature)->withGeometry(...)->withProperties(...)->withType(...)
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
     * GeoJSON Geometry object per RFC 7946. Coordinates use [longitude, latitude] order. 3D coordinates [lng, lat, elevation] are used for elevation endpoints.
     *
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
    public function withType(
        Type|string $type
    ): self {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
