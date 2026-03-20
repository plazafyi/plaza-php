<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Standard API error envelope. Every error response wraps a single `error` object with a machine-readable `code`, a human-readable `message`, and optional structured `details`.
 *
 * @phpstan-import-type ErrorShape from \Plaza\PlazaClientService\Error\Error as ErrorShape1
 *
 * @phpstan-type ErrorShape = array{
 *   error: \Plaza\PlazaClientService\Error\Error|ErrorShape1
 * }
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Error payload.
     */
    #[Required]
    public Error\Error $error;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(error: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withError(...)
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
     * @param Error\Error|ErrorShape1 $error
     */
    public static function with(
        Error\Error|array $error
    ): self {
        $self = new self;

        $self['error'] = $error;

        return $self;
    }

    /**
     * Error payload.
     *
     * @param Error\Error|ErrorShape1 $error
     */
    public function withError(
        Error\Error|array $error
    ): self {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
