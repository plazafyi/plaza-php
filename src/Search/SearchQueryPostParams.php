<?php

declare(strict_types=1);

namespace Plaza\Search;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Search OSM features by name.
 *
 * @see Plaza\Services\SearchService::queryPost()
 *
 * @phpstan-type SearchQueryPostParamsShape = array{
 *   q: string,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   outputFields?: string|null,
 *   outputInclude?: string|null,
 *   outputPrecision?: int|null,
 *   outputSort?: string|null,
 * }
 */
final class SearchQueryPostParams implements BaseModel
{
    /** @use SdkModel<SearchQueryPostParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query string.
     */
    #[Required]
    public string $q;

    /**
     * Cursor for pagination.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum results (default 25, max 100).
     */
    #[Optional]
    public ?int $limit;

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
     * Sort by: distance, name, osm_id.
     */
    #[Optional]
    public ?string $outputSort;

    /**
     * `new SearchQueryPostParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SearchQueryPostParams::with(q: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SearchQueryPostParams)->withQ(...)
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
        string $q,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?string $outputSort = null,
    ): self {
        $self = new self;

        $self['q'] = $q;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $outputFields && $self['outputFields'] = $outputFields;
        null !== $outputInclude && $self['outputInclude'] = $outputInclude;
        null !== $outputPrecision && $self['outputPrecision'] = $outputPrecision;
        null !== $outputSort && $self['outputSort'] = $outputSort;

        return $self;
    }

    /**
     * Search query string.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

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
     * Maximum results (default 25, max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

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
     * Sort by: distance, name, osm_id.
     */
    public function withOutputSort(string $outputSort): self
    {
        $self = clone $this;
        $self['outputSort'] = $outputSort;

        return $self;
    }
}
