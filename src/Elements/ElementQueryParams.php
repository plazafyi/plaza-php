<?php

declare(strict_types=1);

namespace Plaza\Elements;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Query features by bounding box or H3 cell.
 *
 * @see Plaza\Services\ElementsService::query()
 *
 * @phpstan-type ElementQueryParamsShape = array{
 *   bbox?: string|null,
 *   cursor?: string|null,
 *   h3?: string|null,
 *   limit?: int|null,
 *   type?: string|null,
 * }
 */
final class ElementQueryParams implements BaseModel
{
    /** @use SdkModel<ElementQueryParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bounding box: south,west,north,east. At least one of bbox or h3 is required.
     */
    #[Optional]
    public ?string $bbox;

    /**
     * Cursor for pagination.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * H3 cell index. At least one of bbox or h3 is required.
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
        ?string $cursor = null,
        ?string $h3 = null,
        ?int $limit = null,
        ?string $type = null,
    ): self {
        $self = new self;

        null !== $bbox && $self['bbox'] = $bbox;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $h3 && $self['h3'] = $h3;
        null !== $limit && $self['limit'] = $limit;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Bounding box: south,west,north,east. At least one of bbox or h3 is required.
     */
    public function withBbox(string $bbox): self
    {
        $self = clone $this;
        $self['bbox'] = $bbox;

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
     * H3 cell index. At least one of bbox or h3 is required.
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
}
