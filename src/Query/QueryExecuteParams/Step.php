<?php

declare(strict_types=1);

namespace Plaza\Query\QueryExecuteParams;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Query\QueryExecuteParams\Step\Type;

/**
 * A single pipeline step.
 *
 * @phpstan-type StepShape = array{type: Type|value-of<Type>, query?: string|null}
 */
final class Step implements BaseModel
{
    /** @use SdkModel<StepShape> */
    use SdkModel;

    /**
     * Step type: `overpass`, `filter`, or `transform`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Query string for this step (required for overpass steps).
     */
    #[Optional]
    public ?string $query;

    /**
     * `new Step()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Step::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Step)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(Type|string $type, ?string $query = null): self
    {
        $self = new self;

        $self['type'] = $type;

        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * Step type: `overpass`, `filter`, or `transform`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Query string for this step (required for overpass steps).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
