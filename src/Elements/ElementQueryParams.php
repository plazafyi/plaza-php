<?php

declare(strict_types=1);

namespace Plaza\Elements;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Query features by spatial predicate, bounding box, or H3 cell.
 *
 * @see Plaza\Services\ElementsService::query()
 *
 * @phpstan-type ElementQueryParamsShape = array{
 *   bbox?: string|null,
 *   contains?: string|null,
 *   crosses?: string|null,
 *   cursor?: string|null,
 *   format?: string|null,
 *   h3?: string|null,
 *   intersects?: string|null,
 *   limit?: int|null,
 *   near?: string|null,
 *   outputBuffer?: float|null,
 *   outputCentroid?: bool|null,
 *   outputFields?: string|null,
 *   outputGeometry?: bool|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 *   outputSimplify?: float|null,
 *   outputSort?: string|null,
 *   radius?: float|null,
 *   touches?: string|null,
 *   type?: string|null,
 *   within?: string|null,
 * }
 */
final class ElementQueryParams implements BaseModel
{
    /** @use SdkModel<ElementQueryParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Legacy shorthand. Bounding box: south,west,north,east. Use spatial predicates (near, within, intersects) instead.
     */
    #[Optional]
    public ?string $bbox;

    /**
     * Geometry that features must contain.
     */
    #[Optional]
    public ?string $contains;

    /**
     * Geometry that features must cross.
     */
    #[Optional]
    public ?string $crosses;

    /**
     * Cursor for pagination.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Response format. json (default) returns paginated GeoJSON. geojson/csv/ndjson stream via chunked transfer encoding.
     */
    #[Optional]
    public ?string $format;

    /**
     * Legacy shorthand. H3 cell index. Use spatial predicates instead.
     */
    #[Optional]
    public ?string $h3;

    /**
     * Geometry that features must intersect.
     */
    #[Optional]
    public ?string $intersects;

    /**
     * Maximum results (default 100, max 10000).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Point geometry for proximity search (lat,lng). Requires radius.
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
     * Search radius in meters (for near) or buffer distance (for other predicates).
     */
    #[Optional]
    public ?float $radius;

    /**
     * Geometry that features must touch.
     */
    #[Optional]
    public ?string $touches;

    /**
     * Element types (comma-separated: node,way,relation).
     */
    #[Optional]
    public ?string $type;

    /**
     * Geometry that features must be within.
     */
    #[Optional]
    public ?string $within;

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
        ?string $bbox = null,
        ?string $contains = null,
        ?string $crosses = null,
        ?string $cursor = null,
        ?string $format = null,
        ?string $h3 = null,
        ?string $intersects = null,
        ?int $limit = null,
        ?string $near = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
        ?float $radius = null,
        ?string $touches = null,
        ?string $type = null,
        ?string $within = null,
    ): self {
        $self = new self;

        null !== $bbox && $self['bbox'] = $bbox;
        null !== $contains && $self['contains'] = $contains;
        null !== $crosses && $self['crosses'] = $crosses;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $format && $self['format'] = $format;
        null !== $h3 && $self['h3'] = $h3;
        null !== $intersects && $self['intersects'] = $intersects;
        null !== $limit && $self['limit'] = $limit;
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
        null !== $touches && $self['touches'] = $touches;
        null !== $type && $self['type'] = $type;
        null !== $within && $self['within'] = $within;

        return $self;
    }

    /**
     * Legacy shorthand. Bounding box: south,west,north,east. Use spatial predicates (near, within, intersects) instead.
     */
    public function withBbox(string $bbox): self
    {
        $self = clone $this;
        $self['bbox'] = $bbox;

        return $self;
    }

    /**
     * Geometry that features must contain.
     */
    public function withContains(string $contains): self
    {
        $self = clone $this;
        $self['contains'] = $contains;

        return $self;
    }

    /**
     * Geometry that features must cross.
     */
    public function withCrosses(string $crosses): self
    {
        $self = clone $this;
        $self['crosses'] = $crosses;

        return $self;
    }

    /**
     * Cursor for pagination.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Response format. json (default) returns paginated GeoJSON. geojson/csv/ndjson stream via chunked transfer encoding.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Legacy shorthand. H3 cell index. Use spatial predicates instead.
     */
    public function withH3(string $h3): self
    {
        $self = clone $this;
        $self['h3'] = $h3;

        return $self;
    }

    /**
     * Geometry that features must intersect.
     */
    public function withIntersects(string $intersects): self
    {
        $self = clone $this;
        $self['intersects'] = $intersects;

        return $self;
    }

    /**
     * Maximum results (default 100, max 10000).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Point geometry for proximity search (lat,lng). Requires radius.
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
     * Search radius in meters (for near) or buffer distance (for other predicates).
     */
    public function withRadius(float $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }

    /**
     * Geometry that features must touch.
     */
    public function withTouches(string $touches): self
    {
        $self = clone $this;
        $self['touches'] = $touches;

        return $self;
    }

    /**
     * Element types (comma-separated: node,way,relation).
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Geometry that features must be within.
     */
    public function withWithin(string $within): self
    {
        $self = clone $this;
        $self['within'] = $within;

        return $self;
    }
}
