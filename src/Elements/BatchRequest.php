<?php

declare(strict_types=1);

namespace Plaza\Elements;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Elements\BatchRequest\Element;

/**
 * Fetch multiple OSM elements by their type and ID in a single request. Maximum 100 elements per batch.
 *
 * @phpstan-import-type ElementShape from \Plaza\Elements\BatchRequest\Element
 *
 * @phpstan-type BatchRequestShape = array{elements: list<Element|ElementShape>}
 */
final class BatchRequest implements BaseModel
{
    /** @use SdkModel<BatchRequestShape> */
    use SdkModel;

    /**
     * Array of element references to fetch.
     *
     * @var list<Element> $elements
     */
    #[Required(list: Element::class)]
    public array $elements;

    /**
     * `new BatchRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BatchRequest::with(elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BatchRequest)->withElements(...)
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
     * @param list<Element|ElementShape> $elements
     */
    public static function with(array $elements): self
    {
        $self = new self;

        $self['elements'] = $elements;

        return $self;
    }

    /**
     * Array of element references to fetch.
     *
     * @param list<Element|ElementShape> $elements
     */
    public function withElements(array $elements): self
    {
        $self = clone $this;
        $self['elements'] = $elements;

        return $self;
    }
}
