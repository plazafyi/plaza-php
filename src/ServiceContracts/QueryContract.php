<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\QueryExecuteParams\Step;
use Plaza\Query\QueryExecuteResponse;
use Plaza\Query\SparqlResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type StepShape from \Plaza\Query\QueryExecuteParams\Step
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface QueryContract
{
    /**
     * @api
     *
     * @param list<Step|StepShape> $steps Ordered list of query steps to execute
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function execute(
        array $steps,
        RequestOptions|array|null $requestOptions = null
    ): QueryExecuteResponse;

    /**
     * @api
     *
     * @param string $data Body param: Overpass QL query string
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function overpass(
        string $data,
        ?string $format = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection;

    /**
     * @api
     *
     * @param string $query SPARQL query string
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function sparql(
        string $query,
        RequestOptions|array|null $requestOptions = null
    ): SparqlResult;
}
