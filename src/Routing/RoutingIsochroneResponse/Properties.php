<?php

declare(strict_types=1);

namespace Plaza\Routing\RoutingIsochroneResponse;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Routing\RoutingIsochroneResponse\Properties\Mode;

/**
 * Isochrone metadata.
 *
 * @phpstan-type PropertiesShape = array{
 *   areaM2?: float|null,
 *   maxCostS?: float|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   timeSeconds?: float|null,
 *   verticesReached?: int|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Area of the isochrone polygon in square meters (multi-contour features only).
     */
    #[Optional('area_m2', nullable: true)]
    public ?float $areaM2;

    /**
     * Maximum actual travel cost in seconds to the isochrone boundary (single contour only).
     */
    #[Optional('max_cost_s', nullable: true)]
    public ?float $maxCostS;

    /**
     * Travel mode used for the isochrone calculation.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Travel time budget in seconds.
     */
    #[Optional('time_seconds')]
    public ?float $timeSeconds;

    /**
     * Number of road network vertices within the isochrone.
     */
    #[Optional('vertices_reached')]
    public ?int $verticesReached;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        ?float $areaM2 = null,
        ?float $maxCostS = null,
        Mode|string|null $mode = null,
        ?float $timeSeconds = null,
        ?int $verticesReached = null,
    ): self {
        $self = new self;

        null !== $areaM2 && $self['areaM2'] = $areaM2;
        null !== $maxCostS && $self['maxCostS'] = $maxCostS;
        null !== $mode && $self['mode'] = $mode;
        null !== $timeSeconds && $self['timeSeconds'] = $timeSeconds;
        null !== $verticesReached && $self['verticesReached'] = $verticesReached;

        return $self;
    }

    /**
     * Area of the isochrone polygon in square meters (multi-contour features only).
     */
    public function withAreaM2(?float $areaM2): self
    {
        $self = clone $this;
        $self['areaM2'] = $areaM2;

        return $self;
    }

    /**
     * Maximum actual travel cost in seconds to the isochrone boundary (single contour only).
     */
    public function withMaxCostS(?float $maxCostS): self
    {
        $self = clone $this;
        $self['maxCostS'] = $maxCostS;

        return $self;
    }

    /**
     * Travel mode used for the isochrone calculation.
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
     * Travel time budget in seconds.
     */
    public function withTimeSeconds(float $timeSeconds): self
    {
        $self = clone $this;
        $self['timeSeconds'] = $timeSeconds;

        return $self;
    }

    /**
     * Number of road network vertices within the isochrone.
     */
    public function withVerticesReached(int $verticesReached): self
    {
        $self = clone $this;
        $self['verticesReached'] = $verticesReached;

        return $self;
    }
}
