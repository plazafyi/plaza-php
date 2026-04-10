<?php

declare(strict_types=1);

namespace Plaza\Features;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\Geometry;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\PlazaClientService\MultiLineStringGeometry;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\MultiPolygonGeometry;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\PlazaClientService\PolygonGeometry;

/**
 * Query features by spatial predicate, bounding box, or H3 cell.
 *
 * @see Plaza\Services\FeaturesService::query()
 *
 * @phpstan-import-type GeometryShape from \Plaza\PlazaClientService\Geometry
 * @phpstan-import-type GeometryVariants from \Plaza\PlazaClientService\Geometry
 *
 * @phpstan-type FeatureQueryParamsShape = array{
 *   cursor?: string|null,
 *   format?: string|null,
 *   h3?: string|null,
 *   limit?: int|null,
 *   type?: string|null,
 *   around?: GeometryShape|null,
 *   contains?: GeometryShape|null,
 *   crosses?: GeometryShape|null,
 *   intersects?: GeometryShape|null,
 *   notContains?: GeometryShape|null,
 *   notIntersects?: GeometryShape|null,
 *   notWithin?: GeometryShape|null,
 *   radius?: float|null,
 *   touches?: GeometryShape|null,
 *   within?: GeometryShape|null,
 * }
 */
final class FeatureQueryParams implements BaseModel
{
    /** @use SdkModel<FeatureQueryParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Maximum results (default 100, max 10000).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Element types (comma-separated: node,way,relation).
     */
    #[Optional]
    public ?string $type;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $around
     */
    #[Optional(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $around;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $contains
     */
    #[Optional(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $contains;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $crosses
     */
    #[Optional(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $crosses;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $intersects
     */
    #[Optional(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $intersects;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $notContains
     */
    #[Optional('not_contains', union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notContains;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $notIntersects
     */
    #[Optional('not_intersects', union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notIntersects;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $notWithin
     */
    #[Optional('not_within', union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notWithin;

    /**
     * Search radius in meters. Required for `around`, optional buffer for other predicates.
     */
    #[Optional]
    public ?float $radius;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $touches
     */
    #[Optional(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $touches;

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @var GeometryVariants|null $within
     */
    #[Optional(union: Geometry::class)]
    public PointGeometry|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $within;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param GeometryShape|null $around
     * @param GeometryShape|null $contains
     * @param GeometryShape|null $crosses
     * @param GeometryShape|null $intersects
     * @param GeometryShape|null $notContains
     * @param GeometryShape|null $notIntersects
     * @param GeometryShape|null $notWithin
     * @param GeometryShape|null $touches
     * @param GeometryShape|null $within
     */
    public static function with(
        ?string $cursor = null,
        ?string $format = null,
        ?string $h3 = null,
        ?int $limit = null,
        ?string $type = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $around = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $contains = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $crosses = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $intersects = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notContains = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notIntersects = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $notWithin = null,
        ?float $radius = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $touches = null,
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry|null $within = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $format && $self['format'] = $format;
        null !== $h3 && $self['h3'] = $h3;
        null !== $limit && $self['limit'] = $limit;
        null !== $type && $self['type'] = $type;
        null !== $around && $self['around'] = $around;
        null !== $contains && $self['contains'] = $contains;
        null !== $crosses && $self['crosses'] = $crosses;
        null !== $intersects && $self['intersects'] = $intersects;
        null !== $notContains && $self['notContains'] = $notContains;
        null !== $notIntersects && $self['notIntersects'] = $notIntersects;
        null !== $notWithin && $self['notWithin'] = $notWithin;
        null !== $radius && $self['radius'] = $radius;
        null !== $touches && $self['touches'] = $touches;
        null !== $within && $self['within'] = $within;

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
     * Maximum results (default 100, max 10000).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

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
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $around
     */
    public function withAround(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $around,
    ): self {
        $self = clone $this;
        $self['around'] = $around;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $contains
     */
    public function withContains(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $contains,
    ): self {
        $self = clone $this;
        $self['contains'] = $contains;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $crosses
     */
    public function withCrosses(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $crosses,
    ): self {
        $self = clone $this;
        $self['crosses'] = $crosses;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $intersects
     */
    public function withIntersects(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $intersects,
    ): self {
        $self = clone $this;
        $self['intersects'] = $intersects;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $notContains
     */
    public function withNotContains(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $notContains,
    ): self {
        $self = clone $this;
        $self['notContains'] = $notContains;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $notIntersects
     */
    public function withNotIntersects(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $notIntersects,
    ): self {
        $self = clone $this;
        $self['notIntersects'] = $notIntersects;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $notWithin
     */
    public function withNotWithin(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $notWithin,
    ): self {
        $self = clone $this;
        $self['notWithin'] = $notWithin;

        return $self;
    }

    /**
     * Search radius in meters. Required for `around`, optional buffer for other predicates.
     */
    public function withRadius(float $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $touches
     */
    public function withTouches(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $touches,
    ): self {
        $self = clone $this;
        $self['touches'] = $touches;

        return $self;
    }

    /**
     * GeoJSON Geometry object per RFC 7946. Discriminated union — the `type` field determines the coordinate structure.
     *
     * @param GeometryShape $within
     */
    public function withWithin(
        PointGeometry|array|LineStringGeometry|PolygonGeometry|MultiPointGeometry|MultiLineStringGeometry|MultiPolygonGeometry $within,
    ): self {
        $self = clone $this;
        $self['within'] = $within;

        return $self;
    }
}
