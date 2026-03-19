<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\TilesRawContract;
use Plaza\Tiles\TileGetParams;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class TilesRawService implements TilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a Mapbox Vector Tile
     *
     * @param int $y Tile Y coordinate
     * @param array{z: int, x: int}|TileGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function get(
        int $y,
        array|TileGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TileGetParams::parseRequest(
            $params,
            $requestOptions,
        );
        $z = $parsed['z'];
        unset($parsed['z']);
        $x = $parsed['x'];
        unset($parsed['x']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/tiles/%1$s/%2$s/%3$s', $z, $x, $y],
            headers: ['Accept' => 'application/vnd.mapbox-vector-tile'],
            options: $options,
            convert: 'string',
        );
    }
}
