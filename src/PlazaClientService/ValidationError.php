<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\ValidationError\Error;

/**
 * Validation error with per-field details. The `details` object maps field names to arrays of error messages.
 *
 * @phpstan-import-type ErrorShape from \Plaza\PlazaClientService\ValidationError\Error
 *
 * @phpstan-type ValidationErrorShape = array{
 *   error: \Plaza\PlazaClientService\ValidationError\Error|ErrorShape
 * }
 */
final class ValidationError implements BaseModel
{
    /** @use SdkModel<ValidationErrorShape> */
    use SdkModel;

    #[Required]
    public Error $error;

    /**
     * `new ValidationError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ValidationError::with(error: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ValidationError)->withError(...)
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
     * @param Error|ErrorShape $error
     */
    public static function with(
        Error|array $error
    ): self {
        $self = new self;

        $self['error'] = $error;

        return $self;
    }

    /**
     * @param Error|ErrorShape $error
     */
    public function withError(
        Error|array $error
    ): self {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
