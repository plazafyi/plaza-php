<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Elevation\ElevationBatchParams;
use Plaza\Elevation\ElevationBatchResult;
use Plaza\Elevation\ElevationLookupParams;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileParams;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElevationRawContract;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
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
     *   geometry: GeoJsonGeometry|GeoJsonGeometryShape
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/elevation/batch',
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
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
     *   lat?: float, lng?: float, locations?: string
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
            query: $parsed,
            headers: ['Accept' => 'application/geo+json'],
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
     *   geometry: GeoJsonGeometry|GeoJsonGeometryShape
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
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
            options: $options,
            convert: ElevationProfileResult::class,
        );
    }
}
