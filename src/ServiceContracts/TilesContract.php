<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface TilesContract
{
    /**
     * @api
     *
     * @param int $y Tile Y coordinate
     * @param int $z Zoom level (0-22)
     * @param int $x Tile X coordinate
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        int $y,
        int $z,
        int $x,
        RequestOptions|array|null $requestOptions = null
    ): string;
}
