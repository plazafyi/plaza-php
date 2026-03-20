<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\MapMatch\MapMatchMatchParams\Coordinate;
use Plaza\MapMatch\MapMatchResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\MapMatchContract;

/**
 * @phpstan-import-type CoordinateShape from \Plaza\MapMatch\MapMatchMatchParams\Coordinate
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class MapMatchService implements MapMatchContract
{
    /**
     * @api
     */
    public MapMatchRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MapMatchRawService($client);
    }

    /**
     * @api
     *
     * Match GPS coordinates to the road network
     *
     * @param list<Coordinate|CoordinateShape> $coordinates GPS coordinates to match, in order of travel (max 50 points)
     * @param list<float>|null $radiuses Search radius per coordinate in meters. Must have the same length as `coordinates` or be omitted entirely. Default: 50m per point.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
        array $coordinates,
        ?array $radiuses = null,
        RequestOptions|array|null $requestOptions = null,
    ): MapMatchResult {
        $params = Util::removeNulls(
            ['coordinates' => $coordinates, 'radiuses' => $radiuses]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->match(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
