<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;
use Plaza\Search\SearchQueryParams;
use Plaza\ServiceContracts\SearchRawContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class SearchRawService implements SearchRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Search OSM features by name
     *
     * @param array{q: string, cursor?: string, limit?: int}|SearchQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function query(
        array|SearchQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SearchQueryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/search',
            query: $parsed,
            headers: ['Accept' => 'application/geo+json'],
            options: $options,
            convert: FeatureCollection::class,
        );
    }
}
