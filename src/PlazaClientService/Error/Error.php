<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService\Error;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Error payload.
 *
 * @phpstan-type ErrorShape = array{
 *   code: string, message: string, details?: array<string,mixed>|null
 * }
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Machine-readable error code (e.g. `invalid_request`, `not_found`, `rate_limited`, `query_error`, `daily_limit_exceeded`).
     */
    #[Required]
    public string $code;

    /**
     * Human-readable explanation of what went wrong.
     */
    #[Required]
    public string $message;

    /**
     * Structured details when available (e.g. field-level validation errors, rate limit metadata, billing info).
     *
     * @var array<string,mixed>|null $details
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $details;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withCode(...)->withMessage(...)
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
     * @param array<string,mixed>|null $details
     */
    public static function with(
        string $code,
        string $message,
        ?array $details = null
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;

        null !== $details && $self['details'] = $details;

        return $self;
    }

    /**
     * Machine-readable error code (e.g. `invalid_request`, `not_found`, `rate_limited`, `query_error`, `daily_limit_exceeded`).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Human-readable explanation of what went wrong.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Structured details when available (e.g. field-level validation errors, rate limit metadata, billing info).
     *
     * @param array<string,mixed>|null $details
     */
    public function withDetails(?array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }
}
