<?php

declare(strict_types=1);

namespace Plaza\Elevation;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Look up elevation at one or more points.
 *
 * @see Plaza\Services\ElevationService::lookup()
 *
 * @phpstan-type ElevationLookupParamsShape = array{
 *   lat?: float|null,
 *   lng?: float|null,
 *   locations?: string|null,
 *   outputFields?: string|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 * }
 */
final class ElevationLookupParams implements BaseModel
{
    /** @use SdkModel<ElevationLookupParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Latitude (single point).
     */
    #[Optional]
    public ?float $lat;

    /**
     * Longitude (single point).
     */
    #[Optional]
    public ?float $lng;

    /**
     * Pipe-separated lng,lat pairs (batch).
     */
    #[Optional]
    public ?string $locations;

    /**
     * Comma-separated property fields to include.
     */
    #[Optional]
    public ?string $outputFields;

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
        ?float $lat = null,
        ?float $lng = null,
        ?string $locations = null,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
    ): self {
        $self = new self;

        null !== $lat && $self['lat'] = $lat;
        null !== $lng && $self['lng'] = $lng;
        null !== $locations && $self['locations'] = $locations;
        null !== $outputFields && $self['outputFields'] = $outputFields;
        null !== $outputInclude && $self['outputInclude'] = $outputInclude;
        null !== $outputPrecision && $self['outputPrecision'] = $outputPrecision;

        return $self;
    }

    /**
     * Latitude (single point).
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Longitude (single point).
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Pipe-separated lng,lat pairs (batch).
     */
    public function withLocations(string $locations): self
    {
        $self = clone $this;
        $self['locations'] = $locations;

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
}
