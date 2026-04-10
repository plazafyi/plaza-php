<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService\ValidationError;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Core\Conversion\ListOf;
use Plaza\PlazaClientService\ValidationError\Error\Code;

/**
 * @phpstan-type ErrorShape = array{
 *   code: Code|value-of<Code>,
 *   message: string,
 *   details?: array<string,list<string>>|null,
 * }
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Always `validation_failed`.
     *
     * @var value-of<Code> $code
     */
    #[Required(enum: Code::class)]
    public string $code;

    /**
     * Human-readable summary.
     */
    #[Required]
    public string $message;

    /**
     * Map of field names to error message arrays.
     *
     * @var array<string,list<string>>|null $details
     */
    #[Optional(map: new ListOf('string'), nullable: true)]
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
     * @param Code|value-of<Code> $code
     * @param array<string,list<string>>|null $details
     */
    public static function with(
        Code|string $code,
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
     * Always `validation_failed`.
     *
     * @param Code|value-of<Code> $code
     */
    public function withCode(Code|string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Human-readable summary.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Map of field names to error message arrays.
     *
     * @param array<string,list<string>>|null $details
     */
    public function withDetails(?array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }
}
