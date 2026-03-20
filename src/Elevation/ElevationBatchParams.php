<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Elevation\ElevationBatchParams\Coordinate;

/**
 * Look up elevation for multiple coordinates.
 *
 * @see Plaza\Services\ElevationService::batch()
 *
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationBatchParams\Coordinate
 *
 * @phpstan-type ElevationBatchParamsShape = array{
 *   coordinates: list<Coordinate|CoordinateShape>, format?: string|null
 * }
 */
final class ElevationBatchParams implements BaseModel
{
    /** @use SdkModel<ElevationBatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Coordinates to look up elevations for (max 50).
     *
     * @var list<Coordinate> $coordinates
     */
    #[Required(list: Coordinate::class)]
    public array $coordinates;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * `new ElevationBatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElevationBatchParams::with(coordinates: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElevationBatchParams)->withCoordinates(...)
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
    public static function with(array $coordinates, ?string $format = null): self
    {
        $self = new self;

        $self['coordinates'] = $coordinates;

        null !== $format && $self['format'] = $format;

        return $self;
    }

    /**
     * Coordinates to look up elevations for (max 50).
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
     * Response format: json (default), geojson, csv, ndjson.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }
}
