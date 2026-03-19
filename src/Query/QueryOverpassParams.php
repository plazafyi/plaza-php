<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Execute an Overpass QL query.
 *
 * @see Plaza\Services\QueryService::overpass()
 *
 * @phpstan-type QueryOverpassParamsShape = array{data: string}
 */
final class QueryOverpassParams implements BaseModel
{
    /** @use SdkModel<QueryOverpassParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Overpass QL query string.
     */
    #[Required]
    public string $data;

    /**
     * `new QueryOverpassParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QueryOverpassParams::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QueryOverpassParams)->withData(...)
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
    public static function with(string $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Overpass QL query string.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
