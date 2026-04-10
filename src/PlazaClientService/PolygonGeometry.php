<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\ListOf;
use Plaza\PlazaClientService\PolygonGeometry\Type;

/**
 * GeoJSON Polygon geometry per RFC 7946. An array of linear rings where the first ring is the exterior boundary and subsequent rings are holes. Each ring must have at least 4 positions with the first and last being identical.
 *
 * @phpstan-type PolygonGeometryShape = array{
 *   coordinates: list<list<list<float>>>, type: Type|value-of<Type>
 * }
 */
final class PolygonGeometry implements BaseModel
{
    /** @use SdkModel<PolygonGeometryShape> */
    use SdkModel;

    /**
     * Array of linear rings (first = exterior, rest = holes).
     *
     * @var list<list<list<float>>> $coordinates
     */
    #[Required(list: new ListOf(new ListOf('float')))]
    public array $coordinates;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new PolygonGeometry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PolygonGeometry::with(coordinates: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PolygonGeometry)->withCoordinates(...)->withType(...)
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
     * @param list<list<list<float>>> $coordinates
     * @param Type|value-of<Type> $type
     */
    public static function with(array $coordinates, Type|string $type): self
    {
        $self = new self;

        $self['coordinates'] = $coordinates;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Array of linear rings (first = exterior, rest = holes).
     *
     * @param list<list<list<float>>> $coordinates
     */
    public function withCoordinates(array $coordinates): self
    {
        $self = clone $this;
        $self['coordinates'] = $coordinates;

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
