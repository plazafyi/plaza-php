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
 *   cursor?: string|null, limit?: int|null
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
     * Maximum results.
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

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
     * Maximum results.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
