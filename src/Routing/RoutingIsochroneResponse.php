<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\Routing\RoutingIsochroneResponse\Properties;
use Plaza\Routing\RoutingIsochroneResponse\Type;

/**
 * GeoJSON Feature or FeatureCollection representing isochrone polygons — areas reachable within the specified travel time(s). Single time value returns a Feature; comma-separated times return a FeatureCollection with one polygon per contour.
 *
 * @phpstan-import-type GeoJsonFeatureShape from \Plaza\PlazaClientService\GeoJsonFeature
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type PropertiesShape from \Plaza\Routing\RoutingIsochroneResponse\Properties
 *
 * @phpstan-type RoutingIsochroneResponseShape = array{
 *   features?: list<GeoJsonFeature|GeoJsonFeatureShape>|null,
 *   geometry?: null|GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties?: null|Properties|PropertiesShape,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class RoutingIsochroneResponse implements BaseModel
{
    /** @use SdkModel<RoutingIsochroneResponseShape> */
    use SdkModel;

    /**
     * Array of isochrone polygon Features (multi-contour only).
     *
     * @var list<GeoJsonFeature>|null $features
     */
    #[Optional(list: GeoJsonFeature::class, nullable: true)]
    public ?array $features;

    /**
     * GeoJSON Geometry object per RFC 7946. Coordinates use [longitude, latitude] order. 3D coordinates [lng, lat, elevation] are used for elevation endpoints.
     */
    #[Optional(nullable: true)]
    public ?GeoJsonGeometry $geometry;

    /**
     * Isochrone metadata.
     */
    #[Optional(nullable: true)]
    public ?Properties $properties;

    /**
     * `Feature` for single contour, `FeatureCollection` for multiple contours.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<GeoJsonFeature|GeoJsonFeatureShape>|null $features
     * @param GeoJsonGeometry|GeoJsonGeometryShape|null $geometry
     * @param Properties|PropertiesShape|null $properties
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?array $features = null,
        GeoJsonGeometry|array|null $geometry = null,
        Properties|array|null $properties = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $features && $self['features'] = $features;
        null !== $geometry && $self['geometry'] = $geometry;
        null !== $properties && $self['properties'] = $properties;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Array of isochrone polygon Features (multi-contour only).
     *
     * @param list<GeoJsonFeature|GeoJsonFeatureShape>|null $features
     */
    public function withFeatures(?array $features): self
    {
        $self = clone $this;
        $self['features'] = $features;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Coordinates use [longitude, latitude] order. 3D coordinates [lng, lat, elevation] are used for elevation endpoints.
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape|null $geometry
     */
    public function withGeometry(GeoJsonGeometry|array|null $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Isochrone metadata.
     *
     * @param Properties|PropertiesShape|null $properties
     */
    public function withProperties(Properties|array|null $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

        return $self;
    }

    /**
     * `Feature` for single contour, `FeatureCollection` for multiple contours.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
