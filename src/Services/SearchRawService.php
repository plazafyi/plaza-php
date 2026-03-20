<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;
use Plaza\Search\SearchQueryParams;
use Plaza\Search\SearchQueryPostParams;
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
     * @param array{
     *   q: string,
     *   cursor?: string,
     *   limit?: int,
     *   outputFields?: string,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     *   outputSort?: string,
     * }|SearchQueryParams $params
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
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                    'outputSort' => 'output[sort]',
                ],
            ),
            options: $options,
            convert: FeatureCollection::class,
        );
    }

    /**
     * @api
     *
     * Search OSM features by name
     *
     * @param array{
     *   q: string,
     *   cursor?: string,
     *   limit?: int,
     *   outputFields?: string,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     *   outputSort?: string,
     * }|SearchQueryPostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function queryPost(
        array|SearchQueryPostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SearchQueryPostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/search',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                    'outputSort' => 'output[sort]',
                ],
            ),
            options: $options,
            convert: FeatureCollection::class,
        );
    }
}
