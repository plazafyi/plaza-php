<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\MapMatch\MapMatchMatchParams;
use Plaza\MapMatch\MapMatchResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface MapMatchRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MapMatchMatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MapMatchResult>
     *
     * @throws APIException
     */
    public function match(
        array|MapMatchMatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
