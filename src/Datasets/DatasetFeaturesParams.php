<?php

declare(strict_types=1);

namespace Plaza\Datasets;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Query features in a dataset.
 *
 * @see Plaza\Services\DatasetsService::features()
 *
 * @phpstan-type DatasetFeaturesParamsShape = array{
 *   cursor?: string|null,
 *   format?: string|null,
 *   limit?: int|null,
 *   outputBuffer?: float|null,
 *   outputCentroid?: bool|null,
 *   outputFields?: string|null,
 *   outputGeometry?: bool|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 *   outputSimplify?: float|null,
 *   outputSort?: string|null,
 * }
 */
final class DatasetFeaturesParams implements BaseModel
{
    /** @use SdkModel<DatasetFeaturesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Cursor for pagination.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * Maximum results.
     */
    #[Optional]
    public ?int $limit;

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
        ?string $cursor = null,
        ?string $format = null,
        ?int $limit = null,
        ?float $outputBuffer = null,
        ?bool $outputCentroid = null,
        ?string $outputFields = null,
        ?bool $outputGeometry = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?float $outputSimplify = null,
        ?string $outputSort = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $format && $self['format'] = $format;
        null !== $limit && $self['limit'] = $limit;
        null !== $outputBuffer && $self['outputBuffer'] = $outputBuffer;
        null !== $outputCentroid && $self['outputCentroid'] = $outputCentroid;
        null !== $outputFields && $self['outputFields'] = $outputFields;
        null !== $outputGeometry && $self['outputGeometry'] = $outputGeometry;
        null !== $outputInclude && $self['outputInclude'] = $outputInclude;
        null !== $outputPrecision && $self['outputPrecision'] = $outputPrecision;
        null !== $outputSimplify && $self['outputSimplify'] = $outputSimplify;
        null !== $outputSort && $self['outputSort'] = $outputSort;

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
     * Response format: json (default), geojson, csv, ndjson.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Maximum results.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

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
}
