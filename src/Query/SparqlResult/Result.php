<?php

declare(strict_types=1);

namespace Plaza\Query\SparqlResult;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\Query\SparqlResult\Result\Type;

/**
 * GeoJSON Feature (may lack @var/@id metadata for untyped results).
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type ResultShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties: array<string,mixed>,
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * GeoJSON Geometry object per RFC 7946. Coordinates use [longitude, latitude] order. 3D coordinates [lng, lat, elevation] are used for elevation endpoints.
     */
    #[Required]
    public GeoJsonGeometry $geometry;

    /**
     * OSM tags as key-value pairs, optionally with `@var` and `@id` metadata.
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
     * Compound identifier in `type/osm_id` format (present when element type is known).
     */
    #[Optional(nullable: true)]
    public ?string $id;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(geometry: ..., properties: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withGeometry(...)->withProperties(...)->withType(...)
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
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['properties'] = $properties;
        $self['type'] = $type;

        null !== $id && $self['id'] = $id;

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
     * OSM tags as key-value pairs, optionally with `@var` and `@id` metadata.
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
     * Compound identifier in `type/osm_id` format (present when element type is known).
     */
    public function withID(?string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
