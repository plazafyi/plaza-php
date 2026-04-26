<?php

declare(strict_types=1);

namespace Plaza\Features;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Features\FeatureBatchParams\Element;

/**
 * Fetch multiple features by type and ID.
 *
 * @see Plaza\Services\FeaturesService::batch()
 *
 * @phpstan-import-type ElementShape from \Plaza\Features\FeatureBatchParams\Element
 *
 * @phpstan-type FeatureBatchParamsShape = array{
 *   elements: list<Element|ElementShape>
 * }
 */
final class FeatureBatchParams implements BaseModel
{
    /** @use SdkModel<FeatureBatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Array of element references to fetch.
     *
     * @var list<Element> $elements
     */
    #[Required(list: Element::class)]
    public array $elements;

    /**
     * `new FeatureBatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeatureBatchParams::with(elements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeatureBatchParams)->withElements(...)
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
