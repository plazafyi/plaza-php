<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Optimize route through waypoints.
 *
 * @see Plaza\Services\OptimizeService::create()
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type OptimizeCreateParamsShape = array{
 *   waypoints: GeoJsonGeometry|GeoJsonGeometryShape,
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
     * Waypoints to visit (GeoJSON MultiPoint geometry, minimum 2 points).
     */
    #[Required]
    public GeoJsonGeometry $waypoints;

    /**
     * Travel mode (default: auto).
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Whether route returns to start (default: true).
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $waypoints
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        GeoJsonGeometry|array $waypoints,
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
     * Waypoints to visit (GeoJSON MultiPoint geometry, minimum 2 points).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $waypoints
     */
    public function withWaypoints(GeoJsonGeometry|array $waypoints): self
    {
        $self = clone $this;
        $self['waypoints'] = $waypoints;

        return $self;
    }

    /**
     * Travel mode (default: auto).
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
     * Whether route returns to start (default: true).
     */
    public function withRoundtrip(bool $roundtrip): self
    {
        $self = clone $this;
        $self['roundtrip'] = $roundtrip;

        return $self;
    }
}
