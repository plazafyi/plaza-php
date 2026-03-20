<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Calculate an isochrone from a point.
 *
 * @see Plaza\Services\RoutingService::isochronePost()
 *
 * @phpstan-type RoutingIsochronePostParamsShape = array{
 *   lat: float,
 *   lng: float,
 *   time: float,
 *   mode?: string|null,
 *   outputFields?: string|null,
 *   outputGeometry?: bool|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 *   outputSimplify?: float|null,
 * }
 */
final class RoutingIsochronePostParams implements BaseModel
{
    /** @use SdkModel<RoutingIsochronePostParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Latitude.
     */
    #[Required]
    public float $lat;

    /**
     * Longitude.
     */
    #[Required]
    public float $lng;

    /**
     * Travel time in seconds (1-7200).
     */
    #[Required]
    public float $time;

    /**
     * Travel mode (auto, foot, bicycle).
     */
    #[Optional]
    public ?string $mode;

    /**
     * Comma-separated property fields to include.
     */
    #[Optional]
    public ?string $outputFields;

    /**
     * Include geometry (default true).
     */
    #[Optional]
    public ?bool $outputGeometry;

    /**
     * Extra computed fields: bbox, center.
     */
    #[Optional]
    public ?string $outputInclude;

    /**
     * Coordinate decimal precision (1-15, default 7).
     */
    #[Optional]
    public ?int $outputPrecision;

    /**
     * Simplify geometry tolerance in meters.
     */
    #[Optional]
    public ?float $outputSimplify;

    /**
     * `new RoutingIsochronePostParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingIsochronePostParams::with(lat: ..., lng: ..., time: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingIsochronePostParams)->withLat(...)->withLng(...)->withTime(...)
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
     */
    public static function with(
        float $lat,
        float $lng,
        float $time,
        ?string $mode = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
    ): self {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;
        $self['time'] = $time;

        null !== $mode && $self['mode'] = $mode;
        null !== $outputFields && $self['outputFields'] = $outputFields;
        null !== $outputGeometry && $self['outputGeometry'] = $outputGeometry;
        null !== $outputInclude && $self['outputInclude'] = $outputInclude;
        null !== $outputPrecision && $self['outputPrecision'] = $outputPrecision;
        null !== $outputSimplify && $self['outputSimplify'] = $outputSimplify;

        return $self;
    }

    /**
     * Latitude.
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Longitude.
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Travel time in seconds (1-7200).
     */
    public function withTime(float $time): self
    {
        $self = clone $this;
        $self['time'] = $time;

        return $self;
    }

    /**
     * Travel mode (auto, foot, bicycle).
     */
    public function withMode(string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Comma-separated property fields to include.
     */
    public function withOutputFields(string $outputFields): self
    {
        $self = clone $this;
        $self['outputFields'] = $outputFields;

        return $self;
    }

    /**
     * Include geometry (default true).
     */
    public function withOutputGeometry(bool $outputGeometry): self
    {
        $self = clone $this;
        $self['outputGeometry'] = $outputGeometry;

        return $self;
    }

    /**
     * Extra computed fields: bbox, center.
     */
    public function withOutputInclude(string $outputInclude): self
    {
        $self = clone $this;
        $self['outputInclude'] = $outputInclude;

        return $self;
    }

    /**
     * Coordinate decimal precision (1-15, default 7).
     */
    public function withOutputPrecision(int $outputPrecision): self
    {
        $self = clone $this;
        $self['outputPrecision'] = $outputPrecision;

        return $self;
    }

    /**
     * Simplify geometry tolerance in meters.
     */
    public function withOutputSimplify(float $outputSimplify): self
    {
        $self = clone $this;
        $self['outputSimplify'] = $outputSimplify;

        return $self;
    }
}
