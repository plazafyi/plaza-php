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
 * @see Plaza\Services\SearchService::query()
 *
 * @phpstan-type SearchQueryParamsShape = array{
 *   q: string, cursor?: string|null, limit?: int|null
 * }
 */
final class SearchQueryParams implements BaseModel
{
    /** @use SdkModel<SearchQueryParamsShape> */
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
     * `new SearchQueryParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SearchQueryParams::with(q: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SearchQueryParams)->withQ(...)
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
        ?int $limit = null
    ): self {
        $self = new self;

        $self['q'] = $q;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

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
}
