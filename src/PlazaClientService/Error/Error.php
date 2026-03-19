<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService\Error;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type ErrorShape = array{code: string, message: string, details?: mixed}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Machine-readable error code.
     */
    #[Required]
    public string $code;

    /**
     * Human-readable error message.
     */
    #[Required]
    public string $message;

    /**
     * Additional error details.
     */
    #[Optional(nullable: true)]
    public mixed $details;

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
     */
    public static function with(
        string $code,
        string $message,
        mixed $details = null
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;

        null !== $details && $self['details'] = $details;

        return $self;
    }

    /**
     * Machine-readable error code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Human-readable error message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Additional error details.
     */
    public function withDetails(mixed $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }
}
