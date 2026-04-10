<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\Routing\MatrixRequest\Mode;

/**
 * Request body for distance matrix calculation. Computes travel durations (and optionally distances) between every origin-destination pair. Maximum 2,500 pairs (origins × destinations), each list capped at 50 coordinates.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type MatrixRequestShape = array{
 *   destinations: list<PointGeometry|PointGeometryShape>,
 *   origins: list<PointGeometry|PointGeometryShape>,
 *   annotations?: string|null,
 *   fallbackSpeed?: float|null,
 *   mode?: null|Mode|value-of<Mode>,
 * }
 */
final class MatrixRequest implements BaseModel
{
    /** @use SdkModel<MatrixRequestShape> */
    use SdkModel;

    /**
     * Array of destination coordinates as GeoJSON Points (max 50).
     *
     * @var list<PointGeometry> $destinations
     */
    #[Required(list: PointGeometry::class)]
    public array $destinations;

    /**
     * Array of origin coordinates as GeoJSON Points (max 50).
     *
     * @var list<PointGeometry> $origins
     */
    #[Required(list: PointGeometry::class)]
    public array $origins;

    /**
     * Comma-separated list of annotations to include: `duration` (always included), `distance`. Example: `duration,distance`.
     */
    #[Optional]
    public ?string $annotations;

    /**
     * Fallback speed in km/h for pairs where no route exists. When set, unreachable pairs get estimated values instead of null.
     */
    #[Optional('fallback_speed', nullable: true)]
    public ?float $fallbackSpeed;

    /**
     * Travel mode (default: `auto`).
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * `new MatrixRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MatrixRequest::with(destinations: ..., origins: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MatrixRequest)->withDestinations(...)->withOrigins(...)
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
     * @param list<PointGeometry|PointGeometryShape> $destinations
     * @param list<PointGeometry|PointGeometryShape> $origins
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        array $destinations,
        array $origins,
        ?string $annotations = null,
        ?float $fallbackSpeed = null,
        Mode|string|null $mode = null,
    ): self {
        $self = new self;

        $self['destinations'] = $destinations;
        $self['origins'] = $origins;

        null !== $annotations && $self['annotations'] = $annotations;
        null !== $fallbackSpeed && $self['fallbackSpeed'] = $fallbackSpeed;
        null !== $mode && $self['mode'] = $mode;

        return $self;
    }

    /**
     * Array of destination coordinates as GeoJSON Points (max 50).
     *
     * @param list<PointGeometry|PointGeometryShape> $destinations
     */
    public function withDestinations(array $destinations): self
    {
        $self = clone $this;
        $self['destinations'] = $destinations;

        return $self;
    }

    /**
     * Array of origin coordinates as GeoJSON Points (max 50).
     *
     * @param list<PointGeometry|PointGeometryShape> $origins
     */
    public function withOrigins(array $origins): self
    {
        $self = clone $this;
        $self['origins'] = $origins;

        return $self;
    }

    /**
     * Comma-separated list of annotations to include: `duration` (always included), `distance`. Example: `duration,distance`.
     */
    public function withAnnotations(string $annotations): self
    {
        $self = clone $this;
        $self['annotations'] = $annotations;

        return $self;
    }

    /**
     * Fallback speed in km/h for pairs where no route exists. When set, unreachable pairs get estimated values instead of null.
     */
    public function withFallbackSpeed(?float $fallbackSpeed): self
    {
        $self = clone $this;
        $self['fallbackSpeed'] = $fallbackSpeed;

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
