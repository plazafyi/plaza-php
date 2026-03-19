<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\SparqlResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\QueryContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class QueryService implements QueryContract
{
    /**
     * @api
     */
    public QueryRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QueryRawService($client);
    }

    /**
     * @api
     *
     * Execute an Overpass QL query
     *
     * @param string $data Overpass QL query string
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function overpass(
        string $data,
        RequestOptions|array|null $requestOptions = null
    ): FeatureCollection {
        $params = Util::removeNulls(['data' => $data]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->overpass(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Execute a SPARQL query
     *
     * @param string $query SPARQL query string
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sparql(
        string $query,
        RequestOptions|array|null $requestOptions = null
    ): SparqlResult {
        $params = Util::removeNulls(['query' => $query]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->sparql(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
