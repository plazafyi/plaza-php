<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;
use Plaza\Search\SearchQueryParams;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface SearchRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SearchQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function query(
        array|SearchQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
