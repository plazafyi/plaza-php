<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\QueryExecuteParams;
use Plaza\Query\QueryExecuteResponse;
use Plaza\Query\QueryOverpassParams;
use Plaza\Query\QuerySparqlParams;
use Plaza\Query\SparqlResult;
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
     * @return BaseResponse<QueryExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        array|QueryExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QueryOverpassParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function overpass(
        array|QueryOverpassParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QuerySparqlParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SparqlResult>
     *
     * @throws APIException
     */
    public function sparql(
        array|QuerySparqlParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
