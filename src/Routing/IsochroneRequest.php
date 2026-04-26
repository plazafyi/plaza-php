<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\Routing\IsochroneRequest\Mode;

/**
 * Request body for isochrone calculation. Computes areas reachable from a point within the given travel time(s).
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type IsochroneRequestShape = array{
 *   geometry: PointGeometry|PointGeometryShape,
 *   time: list<int>,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class IsochroneRequest implements BaseModel
{
    /** @use SdkModel<IsochroneRequestShape> */
    use SdkModel;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Required]
    public PointGeometry $geometry;

    /**
     * Travel time budgets in seconds. Each value produces one contour polygon.
     *
     * @var list<int> $time
     */
    #[Required(list: 'int')]
    public array $time;

    /**
     * Travel mode (default: `auto`).
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * `new IsochroneRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IsochroneRequest::with(geometry: ..., time: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IsochroneRequest)->withGeometry(...)->withTime(...)
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
     * @param PointGeometry|PointGeometryShape $geometry
     * @param list<int> $time
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        PointGeometry|array $geometry,
        array $time,
        Mode|string|null $mode = null
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['time'] = $time;

        null !== $mode && $self['mode'] = $mode;

        return $self;
    }

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     *
     * @param PointGeometry|PointGeometryShape $geometry
     */
    public function withGeometry(PointGeometry|array $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * Travel time budgets in seconds. Each value produces one contour polygon.
     *
     * @param list<int> $time
     */
    public function withTime(array $time): self
    {
        $self = clone $this;
        $self['time'] = $time;

        return $self;
    }

    /**
     * Travel mode (default: `auto`).
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }
}
