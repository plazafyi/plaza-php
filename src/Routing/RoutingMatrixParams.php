<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\Routing\RoutingMatrixParams\Mode;

/**
 * Calculate a distance matrix between points.
 *
 * @see Plaza\Services\RoutingService::matrix()
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 *
 * @phpstan-type RoutingMatrixParamsShape = array{
 *   destinations: GeoJsonGeometry|GeoJsonGeometryShape,
 *   origins: GeoJsonGeometry|GeoJsonGeometryShape,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class RoutingMatrixParams implements BaseModel
{
    /** @use SdkModel<RoutingMatrixParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Destination points (GeoJSON MultiPoint geometry).
     */
    #[Required]
    public GeoJsonGeometry $destinations;

    /**
     * Origin points (GeoJSON MultiPoint geometry).
     */
    #[Required]
    public GeoJsonGeometry $origins;

    /**
     * Travel mode.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * `new RoutingMatrixParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingMatrixParams::with(destinations: ..., origins: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingMatrixParams)->withDestinations(...)->withOrigins(...)
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $destinations
     * @param GeoJsonGeometry|GeoJsonGeometryShape $origins
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        GeoJsonGeometry|array $destinations,
        GeoJsonGeometry|array $origins,
        Mode|string|null $mode = null,
    ): self {
        $self = new self;

        $self['destinations'] = $destinations;
        $self['origins'] = $origins;

        null !== $mode && $self['mode'] = $mode;

        return $self;
    }

    /**
     * Destination points (GeoJSON MultiPoint geometry).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $destinations
     */
    public function withDestinations(GeoJsonGeometry|array $destinations): self
    {
        $self = clone $this;
        $self['destinations'] = $destinations;

        return $self;
    }

    /**
     * Origin points (GeoJSON MultiPoint geometry).
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $origins
     */
    public function withOrigins(GeoJsonGeometry|array $origins): self
    {
        $self = clone $this;
        $self['origins'] = $origins;

        return $self;
    }

    /**
     * Travel mode.
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
