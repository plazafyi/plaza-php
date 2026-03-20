<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Elevation\ElevationBatchParams;
use Plaza\Elevation\ElevationBatchParams\Coordinate;
use Plaza\Elevation\ElevationBatchResult;
use Plaza\Elevation\ElevationLookupParams;
use Plaza\Elevation\ElevationLookupPostParams;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileParams;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElevationRawContract;

/**
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationBatchParams\Coordinate
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationProfileParams\Coordinate as CoordinateShape1
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class ElevationRawService implements ElevationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Look up elevation for multiple coordinates
     *
     * @param array{
     *   coordinates: list<Coordinate|CoordinateShape>, format?: string
     * }|ElevationBatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ElevationBatchResult>
     *
     * @throws APIException
     */
    public function batch(
        array|ElevationBatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElevationBatchParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/elevation/batch',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: ElevationBatchResult::class,
        );
    }

    /**
     * @api
     *
     * Look up elevation at one or more points
     *
     * @param array{
     *   format?: string,
     *   lat?: float,
     *   lng?: float,
     *   locations?: string,
     *   outputFields?: string,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     * }|ElevationLookupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ElevationLookupResult>
     *
     * @throws APIException
     */
    public function lookup(
        array|ElevationLookupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElevationLookupParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/elevation',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                ],
            ),
            options: $options,
            convert: ElevationLookupResult::class,
        );
    }

    /**
     * @api
     *
     * Look up elevation at one or more points
     *
     * @param array{
     *   format?: string,
     *   lat?: float,
     *   lng?: float,
     *   locations?: string,
     *   outputFields?: string,
     *   outputInclude?: string,
     *   outputPrecision?: int,
     * }|ElevationLookupPostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ElevationLookupResult>
     *
     * @throws APIException
     */
    public function lookupPost(
        array|ElevationLookupPostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElevationLookupPostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/elevation',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'outputFields' => 'output[fields]',
                    'outputInclude' => 'output[include]',
                    'outputPrecision' => 'output[precision]',
                ],
            ),
            options: $options,
            convert: ElevationLookupResult::class,
        );
    }

    /**
     * @api
     *
     * Elevation profile along coordinates
     *
     * @param array{
     *   coordinates: list<ElevationProfileParams\Coordinate|CoordinateShape1>,
     * }|ElevationProfileParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ElevationProfileResult>
     *
     * @throws APIException
     */
    public function profile(
        array|ElevationProfileParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElevationProfileParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/elevation/profile',
            body: (object) $parsed,
            options: $options,
            convert: ElevationProfileResult::class,
        );
    }
}
