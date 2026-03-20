<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Elevation\ElevationProfileRequest\Coordinate;

/**
 * Request body for elevation profile along a path. Provide at least 2 coordinates defining the path. Maximum 50 coordinates per request.
 *
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationProfileRequest\Coordinate
 *
 * @phpstan-type ElevationProfileRequestShape = array{
 *   coordinates: list<Coordinate|CoordinateShape>
 * }
 */
final class ElevationProfileRequest implements BaseModel
{
    /** @use SdkModel<ElevationProfileRequestShape> */
    use SdkModel;

    /**
     * Path coordinates in order of travel (min 2, max 50).
     *
     * @var list<Coordinate> $coordinates
     */
    #[Required(list: Coordinate::class)]
    public array $coordinates;

    /**
     * `new ElevationProfileRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationProfileRequest::with(coordinates: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationProfileRequest)->withCoordinates(...)
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
