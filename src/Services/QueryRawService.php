<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\QueryExecuteParams;
use Plaza\Query\QueryExecuteParams\Step;
use Plaza\Query\QueryExecuteResponse;
use Plaza\Query\QueryOverpassParams;
use Plaza\Query\QuerySparqlParams;
use Plaza\Query\SparqlResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\QueryRawContract;

/**
 * @phpstan-import-type StepShape from \Plaza\Query\QueryExecuteParams\Step
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class QueryRawService implements QueryRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Execute a multi-step query pipeline
     *
     * @param array{steps: list<Step|StepShape>}|QueryExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<QueryExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        array|QueryExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QueryExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/query',
            body: (object) $parsed,
            options: $options,
            convert: QueryExecuteResponse::class,
        );
    }

    /**
     * @api
     *
     * Execute an Overpass QL query
     *
     * @param array{data: string, format?: string}|QueryOverpassParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function overpass(
        array|QueryOverpassParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QueryOverpassParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/overpass',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: FeatureCollection::class,
        );
    }

    /**
     * @api
     *
     * Execute a SPARQL query
     *
     * @param array{query: string}|QuerySparqlParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SparqlResult>
     *
     * @throws APIException
     */
    public function sparql(
        array|QuerySparqlParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QuerySparqlParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/sparql',
            body: (object) $parsed,
            options: $options,
            convert: SparqlResult::class,
        );
    }
}
