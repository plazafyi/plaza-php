<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * PlazaQL query request. The query is executed against Plaza's OSM database and results are returned as GeoJSON.
 *
 * @phpstan-type PlazaqlQueryShape = array{data: string}
 */
final class PlazaqlQuery implements BaseModel
{
    /** @use SdkModel<PlazaqlQueryShape> */
    use SdkModel;

    /**
     * PlazaQL query string.
     */
    #[Required]
    public string $data;

    /**
     * `new PlazaqlQuery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlazaqlQuery::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlazaqlQuery)->withData(...)
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
     * PlazaQL query string.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
