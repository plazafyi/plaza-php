<?php

declare(strict_types=1);

namespace Plaza\Routing;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\ListOf;

/**
 * @phpstan-type MatrixResultShape = array{
 *   distances: list<list<float|null>>, durations: list<list<float|null>>
 * }
 */
final class MatrixResult implements BaseModel
{
    /** @use SdkModel<MatrixResultShape> */
    use SdkModel;

    /**
     * Distance matrix (meters), origins x destinations.
     *
     * @var list<list<float|null>> $distances
     */
    #[Required(list: new ListOf('float', nullable: true))]
    public array $distances;

    /**
     * Duration matrix (seconds), origins x destinations.
     *
     * @var list<list<float|null>> $durations
     */
    #[Required(list: new ListOf('float', nullable: true))]
    public array $durations;

    /**
     * `new MatrixResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MatrixResult::with(distances: ..., durations: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MatrixResult)->withDistances(...)->withDurations(...)
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
     * @param list<list<float|null>> $distances
     * @param list<list<float|null>> $durations
     */
    public static function with(array $distances, array $durations): self
    {
        $self = new self;

        $self['distances'] = $distances;
        $self['durations'] = $durations;

        return $self;
    }

    /**
     * Distance matrix (meters), origins x destinations.
     *
     * @param list<list<float|null>> $distances
     */
    public function withDistances(array $distances): self
    {
        $self = clone $this;
        $self['distances'] = $distances;

        return $self;
    }

    /**
     * Duration matrix (seconds), origins x destinations.
     *
     * @param list<list<float|null>> $durations
     */
    public function withDurations(array $durations): self
    {
        $self = clone $this;
        $self['durations'] = $durations;

        return $self;
    }
}
