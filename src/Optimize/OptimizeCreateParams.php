<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeCreateParams\Waypoint;

/**
 * Optimize route through waypoints.
 *
 * @see Plaza\Services\OptimizeService::create()
 *
 * @phpstan-import-type WaypointShape from \Plaza\Optimize\OptimizeCreateParams\Waypoint
 *
 * @phpstan-type OptimizeCreateParamsShape = array{
 *   waypoints: list<Waypoint|WaypointShape>,
 *   format?: string|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   roundtrip?: bool|null,
 * }
 */
final class OptimizeCreateParams implements BaseModel
{
    /** @use SdkModel<OptimizeCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Waypoints to visit in optimized order (2-50 points).
     *
     * @var list<Waypoint> $waypoints
     */
    #[Required(list: Waypoint::class)]
    public array $waypoints;

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
     * Whether the route should return to the starting waypoint (default: true).
     */
    #[Optional]
    public ?bool $roundtrip;

    /**
     * `new OptimizeCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OptimizeCreateParams::with(waypoints: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OptimizeCreateParams)->withWaypoints(...)
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
     * @param list<Waypoint|WaypointShape> $waypoints
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        array $waypoints,
        ?string $format = null,
        Mode|string|null $mode = null,
        ?bool $roundtrip = null,
    ): self {
        $self = new self;

        $self['waypoints'] = $waypoints;

        null !== $format && $self['format'] = $format;
        null !== $mode && $self['mode'] = $mode;
        null !== $roundtrip && $self['roundtrip'] = $roundtrip;

        return $self;
    }

    /**
     * Waypoints to visit in optimized order (2-50 points).
     *
     * @param list<Waypoint|WaypointShape> $waypoints
     */
    public function withWaypoints(array $waypoints): self
    {
        $self = clone $this;
        $self['waypoints'] = $waypoints;

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

    /**
     * Whether the route should return to the starting waypoint (default: true).
     */
    public function withRoundtrip(bool $roundtrip): self
    {
        $self = clone $this;
        $self['roundtrip'] = $roundtrip;

        return $self;
    }
}
