<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\RequestOptions;
use Plaza\Tiles\TileGetParams;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface TilesRawContract
{
    /**
     * @api
     *
     * @param int $y Tile Y coordinate
     * @param array<string,mixed>|TileGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function get(
        int $y,
        array|TileGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
