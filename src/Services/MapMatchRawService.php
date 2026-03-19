<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\MapMatch\MapMatchMatchParams;
use Plaza\MapMatch\MapMatchResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\MapMatchRawContract;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class MapMatchRawService implements MapMatchRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Match GPS coordinates to the road network
     *
     * @param array{
     *   trace: GeoJsonGeometry|GeoJsonGeometryShape, radiuses?: list<float>|null
     * }|MapMatchMatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MapMatchResult>
     *
     * @throws APIException
     */
    public function match(
        array|MapMatchMatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MapMatchMatchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/map-match',
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
            options: $options,
            convert: MapMatchResult::class,
        );
    }
}
