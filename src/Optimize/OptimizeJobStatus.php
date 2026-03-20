<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeJobStatus\Status;

/**
 * Status of an async optimization job. When `completed`, the `result` field contains the full OptimizeCompletedResult. When `processing`, the job is still running — poll again. Failed jobs return a standard Error response (HTTP 422), not this schema.
 *
 * @phpstan-import-type OptimizeCompletedResultShape from \Plaza\Optimize\OptimizeCompletedResult
 *
 * @phpstan-type OptimizeJobStatusShape = array{
 *   status: Status|value-of<Status>,
 *   result?: null|OptimizeCompletedResult|OptimizeCompletedResultShape,
 * }
 */
final class OptimizeJobStatus implements BaseModel
{
    /** @use SdkModel<OptimizeJobStatusShape> */
    use SdkModel;

    /**
     * Current job state.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Completed optimization result as a GeoJSON FeatureCollection. Each Feature is a waypoint in optimized visit order. Top-level fields provide summary statistics.
     */
    #[Optional(nullable: true)]
    public ?OptimizeCompletedResult $result;

    /**
     * `new OptimizeJobStatus()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OptimizeJobStatus::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OptimizeJobStatus)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param OptimizeCompletedResult|OptimizeCompletedResultShape|null $result
     */
    public static function with(
        Status|string $status,
        OptimizeCompletedResult|array|null $result = null
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $result && $self['result'] = $result;

        return $self;
    }

    /**
     * Current job state.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Completed optimization result as a GeoJSON FeatureCollection. Each Feature is a waypoint in optimized visit order. Top-level fields provide summary statistics.
     *
     * @param OptimizeCompletedResult|OptimizeCompletedResultShape|null $result
     */
    public function withResult(OptimizeCompletedResult|array|null $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
