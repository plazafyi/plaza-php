<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeProcessingResult\Status;

/**
 * Async optimization in progress — poll with the job_id.
 *
 * @phpstan-type OptimizeProcessingResultShape = array{
 *   jobID: string, status: Status|value-of<Status>
 * }
 */
final class OptimizeProcessingResult implements BaseModel
{
    /** @use SdkModel<OptimizeProcessingResultShape> */
    use SdkModel;

    /**
     * Job ID for polling.
     */
    #[Required('job_id')]
    public string $jobID;

    /**
     * Job status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new OptimizeProcessingResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OptimizeProcessingResult::with(jobID: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OptimizeProcessingResult)->withJobID(...)->withStatus(...)
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
     */
    public static function with(string $jobID, Status|string $status): self
    {
        $self = new self;

        $self['jobID'] = $jobID;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Job ID for polling.
     */
    public function withJobID(string $jobID): self
    {
        $self = clone $this;
        $self['jobID'] = $jobID;

        return $self;
    }

    /**
     * Job status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
