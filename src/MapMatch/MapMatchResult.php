<?php

declare(strict_types=1);

namespace Plaza\MapMatch;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\MapOf;
use Plaza\MapMatch\MapMatchResult\Properties;
use Plaza\MapMatch\MapMatchResult\Type;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Map matching result with snapped geometry.
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type PropertiesShape from \Plaza\MapMatch\MapMatchResult\Properties
 *
 * @phpstan-type MapMatchResultShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties: Properties|PropertiesShape,
 *   type: Type|value-of<Type>,
 *   legs?: list<array<string,mixed>>|null,
 * }
 */
final class MapMatchResult implements BaseModel
{
    /** @use SdkModel<MapMatchResultShape> */
    use SdkModel;

    #[Required]
    public GeoJsonGeometry $geometry;

    #[Required]
    public Properties $properties;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Matched route legs between consecutive trace points.
     *
     * @var list<array<string,mixed>>|null $legs
     */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $legs;

    /**
     * `new MapMatchResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MapMatchResult::with(geometry: ..., properties: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MapMatchResult)->withGeometry(...)->withProperties(...)->withType(...)
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
     * @param list<array<string,mixed>>|null $legs
     */
    public static function with(
        GeoJsonGeometry|array $geometry,
        Properties|array $properties,
        Type|string $type,
        ?array $legs = null,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['properties'] = $properties;
        $self['type'] = $type;

        null !== $legs && $self['legs'] = $legs;

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

    /**
     * Matched route legs between consecutive trace points.
     *
     * @param list<array<string,mixed>> $legs
     */
    public function withLegs(array $legs): self
    {
        $self = clone $this;
        $self['legs'] = $legs;

        return $self;
    }
}
