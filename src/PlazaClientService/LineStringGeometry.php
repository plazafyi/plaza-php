<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\ListOf;
use Plaza\PlazaClientService\LineStringGeometry\Type;

/**
 * GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
 *
 * @phpstan-type LineStringGeometryShape = array{
 *   coordinates: list<list<float>>, type: Type|value-of<Type>
 * }
 */
final class LineStringGeometry implements BaseModel
{
    /** @use SdkModel<LineStringGeometryShape> */
    use SdkModel;

    /**
     * Array of [lng, lat] or [lng, lat, alt] positions.
     *
     * @var list<list<float>> $coordinates
     */
    #[Required(list: new ListOf('float'))]
    public array $coordinates;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new LineStringGeometry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LineStringGeometry::with(coordinates: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LineStringGeometry)->withCoordinates(...)->withType(...)
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
     * @param list<list<float>> $coordinates
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
     * Array of [lng, lat] or [lng, lat, alt] positions.
     *
     * @param list<list<float>> $coordinates
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
