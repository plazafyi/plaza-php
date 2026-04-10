<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeRequest\Mode;
use Plaza\PlazaClientService\MultiPointGeometry;

/**
 * Route optimization (Travelling Salesman) request. Finds the most efficient order to visit a set of waypoints. Minimum 2 waypoints, maximum 50. For large inputs, the request may be processed asynchronously.
 *
 * @phpstan-import-type MultiPointGeometryShape from \Plaza\PlazaClientService\MultiPointGeometry
 *
 * @phpstan-type OptimizeRequestShape = array{
 *   waypoints: MultiPointGeometry|MultiPointGeometryShape,
 *   mode?: null|Mode|value-of<Mode>,
 *   roundtrip?: bool|null,
 * }
 */
final class OptimizeRequest implements BaseModel
{
    /** @use SdkModel<OptimizeRequestShape> */
    use SdkModel;

    /**
     * GeoJSON MultiPoint geometry per RFC 7946. An array of positions.
     */
    #[Required]
    public MultiPointGeometry $waypoints;

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
     * `new OptimizeRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OptimizeRequest::with(waypoints: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OptimizeRequest)->withWaypoints(...)
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
     * @param MultiPointGeometry|MultiPointGeometryShape $waypoints
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        MultiPointGeometry|array $waypoints,
        Mode|string|null $mode = null,
        ?bool $roundtrip = null,
    ): self {
        $self = new self;

        $self['waypoints'] = $waypoints;

        null !== $mode && $self['mode'] = $mode;
        null !== $roundtrip && $self['roundtrip'] = $roundtrip;

        return $self;
    }

    /**
     * GeoJSON MultiPoint geometry per RFC 7946. An array of positions.
     *
     * @param MultiPointGeometry|MultiPointGeometryShape $waypoints
     */
    public function withWaypoints(MultiPointGeometry|array $waypoints): self
    {
        $self = clone $this;
        $self['waypoints'] = $waypoints;

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
