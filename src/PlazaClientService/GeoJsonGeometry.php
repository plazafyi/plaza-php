<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry\Coordinates;
use Plaza\PlazaClientService\GeoJsonGeometry\Type;

/**
 * GeoJSON Geometry object per RFC 7946. Coordinates use [longitude, latitude] order. 3D coordinates [lng, lat, elevation] are used for elevation endpoints.
 *
 * @phpstan-import-type CoordinatesVariants from \Plaza\PlazaClientService\GeoJsonGeometry\Coordinates
 * @phpstan-import-type CoordinatesShape from \Plaza\PlazaClientService\GeoJsonGeometry\Coordinates
 *
 * @phpstan-type GeoJsonGeometryShape = array{
 *   coordinates: CoordinatesShape, type: Type|value-of<Type>
 * }
 */
final class GeoJsonGeometry implements BaseModel
{
    /** @use SdkModel<GeoJsonGeometryShape> */
    use SdkModel;

    /**
     * Coordinates array. Nesting depth varies by geometry type: Point = [lng, lat], LineString = [[lng, lat], ...], Polygon = [[[lng, lat], ...], ...], etc.
     *
     * @var CoordinatesVariants $coordinates
     */
    #[Required(union: Coordinates::class)]
    public array $coordinates;

    /**
     * Geometry type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new GeoJsonGeometry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeoJsonGeometry::with(coordinates: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeoJsonGeometry)->withCoordinates(...)->withType(...)
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
     * @param CoordinatesShape $coordinates
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
     * Coordinates array. Nesting depth varies by geometry type: Point = [lng, lat], LineString = [[lng, lat], ...], Polygon = [[[lng, lat], ...], ...], etc.
     *
     * @param CoordinatesShape $coordinates
     */
    public function withCoordinates(array $coordinates): self
    {
        $self = clone $this;
        $self['coordinates'] = $coordinates;

        return $self;
    }

    /**
     * Geometry type.
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
