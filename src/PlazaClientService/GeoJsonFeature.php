<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonFeature\Type;

/**
 * GeoJSON Feature representing an OSM element. Tags from the original OSM element are flattened directly into `properties` (not nested under a `tags` key). Metadata fields `@var` and `@id` identify the OSM element type and ID within properties.
 *
 * @phpstan-import-type GeometryVariants from \Plaza\PlazaClientService\Geometry
 * @phpstan-import-type GeometryShape from \Plaza\PlazaClientService\Geometry
 *
 * @phpstan-type GeoJsonFeatureShape = array{
 *   geometry: GeometryShape,
 *   properties: array<string,mixed>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 * }
 */
final class GeoJsonFeature implements BaseModel
{
    /** @use SdkModel<GeoJsonFeatureShape> */
    use SdkModel;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants $geometry
     */
    #[Required(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $geometry;

    /**
     * OSM tags flattened as key-value pairs, plus `@var` (node/way/relation) and `@id` (OSM ID) metadata fields. May include `distance_m` for proximity queries.
     *
     * @var array<string,mixed> $properties
     */
    #[Required(map: 'mixed')]
    public array $properties;

    /**
     * Always `Feature`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Compound identifier in `type/osm_id` format.
     */
    #[Optional]
    public ?string $id;

    /**
     * `new GeoJsonFeature()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeoJsonFeature::with(geometry: ..., properties: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeoJsonFeature)->withGeometry(...)->withProperties(...)->withType(...)
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
     * @param array<string,mixed> $properties
     * @param Type|value-of<Type> $type
     */
    public static function with(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $geometry,
        array $properties,
        Type|string $type,
        ?string $id = null,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['properties'] = $properties;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;

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
     * OSM tags flattened as key-value pairs, plus `@var` (node/way/relation) and `@id` (OSM ID) metadata fields. May include `distance_m` for proximity queries.
     *
     * @param array<string,mixed> $properties
     */
    public function withProperties(array $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

        return $self;
    }

    /**
     * Always `Feature`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Compound identifier in `type/osm_id` format.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
