<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeJobStatus\Status;

/**
 * Status of an async optimization job.
 *
 * @phpstan-type OptimizeJobStatusShape = array{
 *   status: Status|value-of<Status>, error?: string|null, result?: mixed
 * }
 */
final class OptimizeJobStatus implements BaseModel
{
    /** @use SdkModel<OptimizeJobStatusShape> */
    use SdkModel;

    /**
     * Job status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Error message when failed.
     */
    #[Optional(nullable: true)]
    public ?string $error;

    /**
     * Optimization result when completed.
     */
    #[Optional(nullable: true)]
    public mixed $result;

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
     */
    public static function with(
        Status|string $status,
        ?string $error = null,
        mixed $result = null
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $error && $self['error'] = $error;
        null !== $result && $self['result'] = $result;

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

    /**
     * Error message when failed.
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Optimization result when completed.
     */
    public function withResult(mixed $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
