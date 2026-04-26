<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Elevation\ElevationLookupParams;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileParams;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElevationRawContract;

/**
 * @phpstan-import-type GeometryShape from \Plaza\Elevation\ElevationLookupParams\Geometry
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
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
     * Look up elevation at one or more points
     *
     * @param array{
     *   geometry: GeometryShape, format?: string
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
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/elevation',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
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
     *   geometry: LineStringGeometry|LineStringGeometryShape
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
