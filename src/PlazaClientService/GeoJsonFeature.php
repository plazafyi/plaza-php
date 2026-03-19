<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonFeature\Type;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type GeoJsonFeatureShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties: array<string,mixed>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   osmID?: int|null,
 * }
 */
final class GeoJsonFeature implements BaseModel
{
    /** @use SdkModel<GeoJsonFeatureShape> */
    use SdkModel;

    #[Required]
    public GeoJsonGeometry $geometry;

    /** @var array<string,mixed> $properties */
    #[Required(map: 'mixed')]
    public array $properties;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Feature identifier (type/osm_id).
     */
    #[Optional]
    public ?string $id;

    /**
     * OpenStreetMap ID.
     */
    #[Optional('osm_id')]
    public ?int $osmID;

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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     * @param array<string,mixed> $properties
     * @param Type|value-of<Type> $type
     */
    public static function with(
        GeoJsonGeometry|array $geometry,
        array $properties,
        Type|string $type,
        ?string $id = null,
        ?int $osmID = null,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['properties'] = $properties;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $osmID && $self['osmID'] = $osmID;

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
     * @param array<string,mixed> $properties
     */
    public function withProperties(array $properties): self
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

    /**
     * Feature identifier (type/osm_id).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * OpenStreetMap ID.
     */
    public function withOsmID(int $osmID): self
    {
        $self = clone $this;
        $self['osmID'] = $osmID;

        return $self;
    }
}
