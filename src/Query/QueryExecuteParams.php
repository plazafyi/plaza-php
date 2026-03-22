<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Execute a PlazaQL query.
 *
 * @see Plaza\Services\QueryService::execute()
 *
 * @phpstan-type QueryExecuteParamsShape = array{
 *   data: string, format?: string|null
 * }
 */
final class QueryExecuteParams implements BaseModel
{
    /** @use SdkModel<QueryExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * PlazaQL query string.
     */
    #[Required]
    public string $data;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * `new QueryExecuteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QueryExecuteParams::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QueryExecuteParams)->withData(...)
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
    public static function with(string $data, ?string $format = null): self
    {
        $self = new self;

        $self['data'] = $data;

        null !== $format && $self['format'] = $format;

        return $self;
    }

    /**
     * PlazaQL query string.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

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
}
