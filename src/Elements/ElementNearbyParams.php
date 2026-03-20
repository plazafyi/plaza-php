<?php

declare(strict_types=1);

namespace Plaza\Elements;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Find features near a geographic point.
 *
 * @see Plaza\Services\ElementsService::nearby()
 *
 * @phpstan-type ElementNearbyParamsShape = array{
 *   lat?: float|null,
 *   limit?: int|null,
 *   lng?: float|null,
 *   near?: string|null,
 *   outputBuffer?: float|null,
 *   outputCentroid?: bool|null,
 *   outputFields?: string|null,
 *   outputGeometry?: bool|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 *   outputSimplify?: float|null,
 *   outputSort?: string|null,
 *   radius?: int|null,
 * }
 */
final class ElementNearbyParams implements BaseModel
{
    /** @use SdkModel<ElementNearbyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Legacy shorthand. Latitude (-90 to 90). Use near param instead.
     */
    #[Optional]
    public ?float $lat;

    /**
     * Maximum results (default 20, max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Legacy shorthand. Longitude (-180 to 180). Use near param instead.
     */
    #[Optional]
    public ?float $lng;

    /**
     * Point geometry for proximity search (lat,lng or GeoJSON). Alternative to lat/lng params.
     */
    #[Optional]
    public ?string $near;

    /**
     * Buffer geometry by meters.
     */
    #[Optional]
    public ?float $outputBuffer;

    /**
     * Replace geometry with centroid.
     */
    #[Optional]
    public ?bool $outputCentroid;

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
     * Simplify geometry tolerance in meters.
     */
    #[Optional]
    public ?float $outputSimplify;

    /**
     * Sort by: distance, name, osm_id.
     */
    #[Optional]
    public ?string $outputSort;

    /**
     * Search radius in meters (default 500, max 10000).
     */
    #[Optional]
    public ?int $radius;

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
        ?int $limit = null,
        ?float $lng = null,
        ?string $near = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        ?int $radius = null,
    ): self {
        $self = new self;

        null !== $lat && $self['lat'] = $lat;
        null !== $limit && $self['limit'] = $limit;
        null !== $lng && $self['lng'] = $lng;
        null !== $near && $self['near'] = $near;
        null !== $outputBuffer && $self['outputBuffer'] = $outputBuffer;
        null !== $outputCentroid && $self['outputCentroid'] = $outputCentroid;
        null !== $outputFields && $self['outputFields'] = $outputFields;
        null !== $outputGeometry && $self['outputGeometry'] = $outputGeometry;
        null !== $outputInclude && $self['outputInclude'] = $outputInclude;
        null !== $outputPrecision && $self['outputPrecision'] = $outputPrecision;
        null !== $outputSimplify && $self['outputSimplify'] = $outputSimplify;
        null !== $outputSort && $self['outputSort'] = $outputSort;
        null !== $radius && $self['radius'] = $radius;

        return $self;
    }

    /**
     * Legacy shorthand. Latitude (-90 to 90). Use near param instead.
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Maximum results (default 20, max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Legacy shorthand. Longitude (-180 to 180). Use near param instead.
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }

    /**
     * Point geometry for proximity search (lat,lng or GeoJSON). Alternative to lat/lng params.
     */
    public function withNear(string $near): self
    {
        $self = clone $this;
        $self['near'] = $near;

        return $self;
    }

    /**
     * Buffer geometry by meters.
     */
    public function withOutputBuffer(float $outputBuffer): self
    {
        $self = clone $this;
        $self['outputBuffer'] = $outputBuffer;

        return $self;
    }

    /**
     * Replace geometry with centroid.
     */
    public function withOutputCentroid(bool $outputCentroid): self
    {
        $self = clone $this;
        $self['outputCentroid'] = $outputCentroid;

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
     * Simplify geometry tolerance in meters.
     */
    public function withOutputSimplify(float $outputSimplify): self
    {
        $self = clone $this;
        $self['outputSimplify'] = $outputSimplify;

        return $self;
    }

    /**
     * Sort by: distance, name, osm_id.
     */
    public function withOutputSort(string $outputSort): self
    {
        $self = clone $this;
        $self['outputSort'] = $outputSort;

        return $self;
    }

    /**
     * Search radius in meters (default 500, max 10000).
     */
    public function withRadius(int $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }
}
