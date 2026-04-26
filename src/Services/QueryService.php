<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;
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
     * Execute a PlazaQL query
     *
     * @param string $data Body param: PlazaQL query string
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function execute(
        string $data,
        ?string $format = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(['data' => $data, 'format' => $format]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->execute(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
