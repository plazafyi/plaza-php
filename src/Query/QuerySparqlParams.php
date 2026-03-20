<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Execute a SPARQL query.
 *
 * @see Plaza\Services\QueryService::sparql()
 *
 * @phpstan-type QuerySparqlParamsShape = array{query: string}
 */
final class QuerySparqlParams implements BaseModel
{
    /** @use SdkModel<QuerySparqlParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * SPARQL query string.
     */
    #[Required]
    public string $query;

    /**
     * `new QuerySparqlParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QuerySparqlParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QuerySparqlParams)->withQuery(...)
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
    public static function with(string $query): self
    {
        $self = new self;

        $self['query'] = $query;

        return $self;
    }

    /**
     * SPARQL query string.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
