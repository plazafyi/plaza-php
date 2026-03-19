<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\MapMatch\MapMatchResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\MapMatchContract;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $trace GPS trace (GeoJSON LineString geometry)
     * @param list<float>|null $radiuses Search radius per coordinate in meters (optional, default 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
        GeoJsonGeometry|array $trace,
        ?array $radiuses = null,
        RequestOptions|array|null $requestOptions = null,
    ): MapMatchResult {
        $params = Util::removeNulls(['trace' => $trace, 'radiuses' => $radiuses]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->match(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
