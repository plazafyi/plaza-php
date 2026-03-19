<?php

declare(strict_types=1);

namespace Plaza\Elements;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Get feature by type and ID.
 *
 * @see Plaza\Services\ElementsService::retrieve()
 *
 * @phpstan-type ElementRetrieveParamsShape = array{type: string}
 */
final class ElementRetrieveParams implements BaseModel
{
    /** @use SdkModel<ElementRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $type;

    /**
     * `new ElementRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ElementRetrieveParams::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ElementRetrieveParams)->withType(...)
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
    public static function with(string $type): self
    {
        $self = new self;

        $self['type'] = $type;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
