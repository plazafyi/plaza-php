<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Elevation\ElevationBatchResult;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface ElevationContract
{
    /**
     * @api
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry Path to profile (GeoJSON LineString geometry, minimum 2 points)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        GeoJsonGeometry|array $geometry,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationBatchResult;

    /**
     * @api
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
    ): ElevationLookupResult;

    /**
     * @api
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry Path to profile (GeoJSON LineString geometry, minimum 2 points)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function profile(
        GeoJsonGeometry|array $geometry,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationProfileResult;
}
