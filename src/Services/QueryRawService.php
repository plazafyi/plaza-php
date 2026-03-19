<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\QueryOverpassParams;
use Plaza\Query\QuerySparqlParams;
use Plaza\Query\SparqlResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\QueryRawContract;

/**
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
     * Execute an Overpass QL query
     *
     * @param array{data: string}|QueryOverpassParams $params
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/overpass',
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
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
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
            options: $options,
            convert: SparqlResult::class,
        );
    }
}
