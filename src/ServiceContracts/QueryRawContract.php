<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\QueryExecuteParams;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface QueryRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|QueryExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function execute(
        array|QueryExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
