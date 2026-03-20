<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Query\QueryExecuteParams\Step;

/**
 * Execute a multi-step query pipeline.
 *
 * @see Plaza\Services\QueryService::execute()
 *
 * @phpstan-import-type StepShape from \Plaza\Query\QueryExecuteParams\Step
 *
 * @phpstan-type QueryExecuteParamsShape = array{steps: list<Step|StepShape>}
 */
final class QueryExecuteParams implements BaseModel
{
    /** @use SdkModel<QueryExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Ordered list of query steps to execute.
     *
     * @var list<Step> $steps
     */
    #[Required(list: Step::class)]
    public array $steps;

    /**
     * `new QueryExecuteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QueryExecuteParams::with(steps: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QueryExecuteParams)->withSteps(...)
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
     * @param list<Step|StepShape> $steps
     */
    public static function with(array $steps): self
    {
        $self = new self;

        $self['steps'] = $steps;

        return $self;
    }

    /**
     * Ordered list of query steps to execute.
     *
     * @param list<Step|StepShape> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }
}
