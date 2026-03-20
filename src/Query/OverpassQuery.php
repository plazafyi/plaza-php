<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Overpass QL query request. The query is executed against Plaza's OSM database and results are returned as GeoJSON.
 *
 * @phpstan-type OverpassQueryShape = array{data: string}
 */
final class OverpassQuery implements BaseModel
{
    /** @use SdkModel<OverpassQueryShape> */
    use SdkModel;

    /**
     * Overpass QL query string.
     */
    #[Required]
    public string $data;

    /**
     * `new OverpassQuery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OverpassQuery::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OverpassQuery)->withData(...)
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
    public static function with(string $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Overpass QL query string.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
