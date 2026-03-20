<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Snap a coordinate to the nearest road.
 *
 * @see Plaza\Services\RoutingService::nearest()
 *
 * @phpstan-type RoutingNearestParamsShape = array{
 *   lat: float,
 *   lng: float,
 *   outputFields?: string|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 *   radius?: int|null,
 * }
 */
final class RoutingNearestParams implements BaseModel
{
    /** @use SdkModel<RoutingNearestParamsShape> */
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
     * Comma-separated property fields to include.
     */
    #[Optional]
    public ?string $outputFields;

    /**
     * Extra computed fields: bbox, distance, center.
     */
    #[Optional]
    public ?string $outputInclude;

    /**
     * Coordinate decimal precision (1-15, default 7).
     */
    #[Optional]
    public ?int $outputPrecision;

    /**
     * Search radius in meters (default 500, max 5000).
     */
    #[Optional]
    public ?int $radius;

    /**
     * `new RoutingNearestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingNearestParams::with(lat: ..., lng: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingNearestParams)->withLat(...)->withLng(...)
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
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?int $radius = null,
    ): self {
        $self = new self;

        $self['lat'] = $lat;
        $self['lng'] = $lng;

        null !== $outputFields && $self['outputFields'] = $outputFields;
        null !== $outputInclude && $self['outputInclude'] = $outputInclude;
        null !== $outputPrecision && $self['outputPrecision'] = $outputPrecision;
        null !== $radius && $self['radius'] = $radius;

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
     * Comma-separated property fields to include.
     */
    public function withOutputFields(string $outputFields): self
    {
        $self = clone $this;
        $self['outputFields'] = $outputFields;

        return $self;
    }

    /**
     * Extra computed fields: bbox, distance, center.
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
     * Search radius in meters (default 500, max 5000).
     */
    public function withRadius(int $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
