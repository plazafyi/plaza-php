<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Elevation\ElevationLookupParams;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileParams;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface ElevationRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ElevationLookupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ElevationLookupResult>
     *
     * @throws APIException
     */
    public function lookup(
        array|ElevationLookupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ElevationProfileParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ElevationProfileResult>
     *
     * @throws APIException
     */
    public function profile(
        array|ElevationProfileParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
