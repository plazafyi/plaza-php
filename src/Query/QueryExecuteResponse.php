<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\MapOf;

/**
 * Pipeline execution result containing the output of each step.
 *
 * @phpstan-type QueryExecuteResponseShape = array{
 *   steps: list<array<string,mixed>>
 * }
 */
final class QueryExecuteResponse implements BaseModel
{
    /** @use SdkModel<QueryExecuteResponseShape> */
    use SdkModel;

    /**
     * Results from each pipeline step in execution order.
     *
     * @var list<array<string,mixed>> $steps
     */
    #[Required(list: new MapOf('mixed'))]
    public array $steps;

    /**
     * `new QueryExecuteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QueryExecuteResponse::with(steps: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QueryExecuteResponse)->withSteps(...)
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
     * @param list<array<string,mixed>> $steps
     */
    public static function with(array $steps): self
    {
        $self = new self;

        $self['steps'] = $steps;

        return $self;
    }

    /**
     * Results from each pipeline step in execution order.
     *
     * @param list<array<string,mixed>> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }
}
