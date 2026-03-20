<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Elevation\ElevationProfileParams\Coordinate;

/**
 * Elevation profile along coordinates.
 *
 * @see Plaza\Services\ElevationService::profile()
 *
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationProfileParams\Coordinate
 *
 * @phpstan-type ElevationProfileParamsShape = array{
 *   coordinates: list<Coordinate|CoordinateShape>
 * }
 */
final class ElevationProfileParams implements BaseModel
{
    /** @use SdkModel<ElevationProfileParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Path coordinates in order of travel (min 2, max 50).
     *
     * @var list<Coordinate> $coordinates
     */
    #[Required(list: Coordinate::class)]
    public array $coordinates;

    /**
     * `new ElevationProfileParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationProfileParams::with(coordinates: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationProfileParams)->withCoordinates(...)
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
     */
    public static function with(array $coordinates): self
    {
        $self = new self;

        $self['coordinates'] = $coordinates;

        return $self;
    }

    /**
     * Path coordinates in order of travel (min 2, max 50).
     *
     * @param list<Coordinate|CoordinateShape> $coordinates
     */
    public function withCoordinates(array $coordinates): self
    {
        $self = clone $this;
        $self['coordinates'] = $coordinates;

        return $self;
    }
}
