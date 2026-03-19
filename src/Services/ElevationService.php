<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Elevation\ElevationBatchResult;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElevationContract;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class ElevationService implements ElevationContract
{
    /**
     * @api
     */
    public ElevationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ElevationRawService($client);
    }

    /**
     * @api
     *
     * Look up elevation for multiple coordinates
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry Path to profile (GeoJSON LineString geometry, minimum 2 points)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        GeoJsonGeometry|array $geometry,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationBatchResult {
        $params = Util::removeNulls(['geometry' => $geometry]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->batch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Look up elevation at one or more points
     *
     * @param float $lat Latitude (single point)
     * @param float $lng Longitude (single point)
     * @param string $locations Pipe-separated lng,lat pairs (batch)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function lookup(
        ?float $lat = null,
        ?float $lng = null,
        ?string $locations = null,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationLookupResult {
        $params = Util::removeNulls(
            ['lat' => $lat, 'lng' => $lng, 'locations' => $locations]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->lookup(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Elevation profile along coordinates
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry Path to profile (GeoJSON LineString geometry, minimum 2 points)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function profile(
        GeoJsonGeometry|array $geometry,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationProfileResult {
        $params = Util::removeNulls(['geometry' => $geometry]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->profile(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
