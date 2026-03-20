<?php

declare(strict_types=1);

namespace Plaza\Tiles;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Get a Mapbox Vector Tile.
 *
 * @see Plaza\Services\TilesService::get()
 *
 * @phpstan-type TileGetParamsShape = array{z: int, x: int}
 */
final class TileGetParams implements BaseModel
{
    /** @use SdkModel<TileGetParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public int $z;

    #[Required]
    public int $x;

    /**
     * `new TileGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TileGetParams::with(z: ..., x: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TileGetParams)->withZ(...)->withX(...)
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
    public static function with(int $z, int $x): self
    {
        $self = new self;

        $self['z'] = $z;
        $self['x'] = $x;

        return $self;
    }

    public function withZ(int $z): self
    {
        $self = clone $this;
        $self['z'] = $z;

        return $self;
    }

    public function withX(int $x): self
    {
        $self = clone $this;
        $self['x'] = $x;

        return $self;
    }
}
