<?php

declare(strict_types=1);

namespace Plaza\Features;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Get feature by type and ID.
 *
 * @see Plaza\Services\FeaturesService::retrieve()
 *
 * @phpstan-type FeatureRetrieveParamsShape = array{type: string}
 */
final class FeatureRetrieveParams implements BaseModel
{
    /** @use SdkModel<FeatureRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $type;

    /**
     * `new FeatureRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeatureRetrieveParams::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeatureRetrieveParams)->withType(...)
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
