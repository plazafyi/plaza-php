<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\Routing\RoutingIsochroneParams\Mode;

/**
 * Calculate an isochrone from a point.
 *
 * @see Plaza\Services\RoutingService::isochrone()
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type RoutingIsochroneParamsShape = array{
 *   geometry: PointGeometry|PointGeometryShape,
 *   time: list<int>,
 *   format?: string|null,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class RoutingIsochroneParams implements BaseModel
{
    /** @use SdkModel<RoutingIsochroneParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * Travel mode (default: `auto`).
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * `new RoutingIsochroneParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingIsochroneParams::with(geometry: ..., time: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingIsochroneParams)->withGeometry(...)->withTime(...)
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
        ?string $format = null,
        Mode|string|null $mode = null,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['time'] = $time;

        null !== $format && $self['format'] = $format;
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
     * Response format: json (default), geojson, csv, ndjson.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

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
