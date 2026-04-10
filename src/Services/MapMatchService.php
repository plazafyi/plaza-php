<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\MapMatch\MapMatchResult;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\MapMatchContract;

/**
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
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
     * @param LineStringGeometry|LineStringGeometryShape $geometry GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     * @param list<float>|null $radiuses Search radius per coordinate in meters. Must have the same length as the geometry coordinates or be omitted entirely. Default: 50m per point.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
        LineStringGeometry|array $geometry,
        ?array $radiuses = null,
        RequestOptions|array|null $requestOptions = null,
    ): MapMatchResult {
        $params = Util::removeNulls(
            ['geometry' => $geometry, 'radiuses' => $radiuses]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->match(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
