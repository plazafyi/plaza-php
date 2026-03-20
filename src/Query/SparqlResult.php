<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Query\SparqlResult\Result;

/**
 * SPARQL query result. Contains a `results` array of GeoJSON Feature objects. Unlike REST feature endpoints, SPARQL results may omit `@var`, `@id`, and compound `id` fields depending on the query shape.
 *
 * @phpstan-import-type ResultShape from \Plaza\Query\SparqlResult\Result
 *
 * @phpstan-type SparqlResultShape = array{results: list<Result|ResultShape>}
 */
final class SparqlResult implements BaseModel
{
    /** @use SdkModel<SparqlResultShape> */
    use SdkModel;

    /**
     * Array of GeoJSON Features matching the SPARQL query. Features include `@var` and `@id` metadata when the source element type is known, but may contain only tags as properties for untyped results.
     *
     * @var list<Result> $results
     */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * `new SparqlResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SparqlResult::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SparqlResult)->withResults(...)
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
     *
     * @param list<Result|ResultShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * Array of GeoJSON Features matching the SPARQL query. Features include `@var` and `@id` metadata when the source element type is known, but may contain only tags as properties for untyped results.
     *
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
