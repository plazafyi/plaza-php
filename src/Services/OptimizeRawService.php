<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Optimize\OptimizeCompletedResult;
use Plaza\Optimize\OptimizeCreateParams;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeJobStatus;
use Plaza\Optimize\OptimizeProcessingResult;
use Plaza\Optimize\OptimizeResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\OptimizeRawContract;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class OptimizeRawService implements OptimizeRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Optimize route through waypoints
     *
     * @param array{
     *   waypoints: GeoJsonGeometry|GeoJsonGeometryShape,
     *   mode?: Mode|value-of<Mode>,
     *   roundtrip?: bool,
     * }|OptimizeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OptimizeCompletedResult|OptimizeProcessingResult>
     *
     * @throws APIException
     */
    public function create(
        array|OptimizeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OptimizeCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/optimize',
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
            options: $options,
            convert: OptimizeResult::class,
        );
    }

    /**
     * @api
     *
     * Get async optimization result
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OptimizeJobStatus>
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/optimize/%1$s', $jobID],
            options: $requestOptions,
            convert: OptimizeJobStatus::class,
        );
    }
}
