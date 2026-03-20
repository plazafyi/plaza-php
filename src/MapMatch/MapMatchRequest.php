<?php

declare(strict_types=1);

namespace Plaza\MapMatch;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\MapMatch\MapMatchRequest\Coordinate;

/**
 * GPS trace to snap to the road network. Provide an array of coordinate objects representing the GPS points. Maximum 50 points per request.
 *
 * @phpstan-import-type CoordinateShape from \Plaza\MapMatch\MapMatchRequest\Coordinate
 *
 * @phpstan-type MapMatchRequestShape = array{
 *   coordinates: list<Coordinate|CoordinateShape>, radiuses?: list<float>|null
 * }
 */
final class MapMatchRequest implements BaseModel
{
    /** @use SdkModel<MapMatchRequestShape> */
    use SdkModel;

    /**
     * GPS coordinates to match, in order of travel (max 50 points).
     *
     * @var list<Coordinate> $coordinates
     */
    #[Required(list: Coordinate::class)]
    public array $coordinates;

    /**
     * Search radius per coordinate in meters. Must have the same length as `coordinates` or be omitted entirely. Default: 50m per point.
     *
     * @var list<float>|null $radiuses
     */
    #[Optional(list: 'float', nullable: true)]
    public ?array $radiuses;

    /**
     * `new MapMatchRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MapMatchRequest::with(coordinates: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MapMatchRequest)->withCoordinates(...)
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
     * @param list<Coordinate|CoordinateShape> $coordinates
     * @param list<float>|null $radiuses
     */
    public static function with(
        array $coordinates,
        ?array $radiuses = null
    ): self {
        $self = new self;

        $self['coordinates'] = $coordinates;

        null !== $radiuses && $self['radiuses'] = $radiuses;

        return $self;
    }

    /**
     * GPS coordinates to match, in order of travel (max 50 points).
     *
     * @param list<Coordinate|CoordinateShape> $coordinates
     */
    public function withCoordinates(array $coordinates): self
    {
        $self = clone $this;
        $self['coordinates'] = $coordinates;

        return $self;
    }

    /**
     * Search radius per coordinate in meters. Must have the same length as `coordinates` or be omitted entirely. Default: 50m per point.
     *
     * @param list<float>|null $radiuses
     */
    public function withRadiuses(?array $radiuses): self
    {
        $self = clone $this;
        $self['radiuses'] = $radiuses;

        return $self;
    }
}
