<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * SPARQL query request. Queries OSM data using SPARQL syntax. Results are returned as a JSON object with a `results` array.
 *
 * @phpstan-type SparqlQueryShape = array{query: string}
 */
final class SparqlQuery implements BaseModel
{
    /** @use SdkModel<SparqlQueryShape> */
    use SdkModel;

    /**
     * SPARQL query string.
     */
    #[Required]
    public string $query;

    /**
     * `new SparqlQuery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SparqlQuery::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SparqlQuery)->withQuery(...)
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
