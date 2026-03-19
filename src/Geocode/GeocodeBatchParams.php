<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Batch geocode multiple addresses.
 *
 * @see Plaza\Services\GeocodeService::batch()
 *
 * @phpstan-type GeocodeBatchParamsShape = array{addresses: list<string>}
 */
final class GeocodeBatchParams implements BaseModel
{
    /** @use SdkModel<GeocodeBatchParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<string> $addresses */
    #[Required(list: 'string')]
    public array $addresses;

    /**
     * `new GeocodeBatchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeBatchParams::with(addresses: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeBatchParams)->withAddresses(...)
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
     * @param list<string> $addresses
     */
    public static function with(array $addresses): self
    {
        $self = new self;

        $self['addresses'] = $addresses;

        return $self;
    }

    /**
     * @param list<string> $addresses
     */
    public function withAddresses(array $addresses): self
    {
        $self = clone $this;
        $self['addresses'] = $addresses;

        return $self;
    }
}
