<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Elevation\ElevationBatchParams\Coordinate;
use Plaza\Elevation\ElevationBatchResult;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationBatchParams\Coordinate
 * @phpstan-import-type CoordinateShape from \Plaza\Elevation\ElevationProfileParams\Coordinate as CoordinateShape1
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface ElevationContract
{
    /**
     * @api
     *
     * @param list<Coordinate|CoordinateShape> $coordinates Body param: Coordinates to look up elevations for (max 50)
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        array $coordinates,
        ?string $format = null,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationBatchResult;

    /**
     * @api
     *
     * @param string $format Response format: json (default), geojson, csv, ndjson
     * @param float $lat Latitude (single point)
     * @param float $lng Longitude (single point)
     * @param string $locations Pipe-separated lng,lat pairs (batch)
     * @param string $outputFields Comma-separated property fields to include
     * @param string $outputInclude Extra computed fields: bbox, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function lookup(
        ?string $format = null,
        ?float $lat = null,
        ?float $lng = null,
        ?string $locations = null,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationLookupResult;

    /**
     * @api
     *
     * @param string $format Response format: json (default), geojson, csv, ndjson
     * @param float $lat Latitude (single point)
     * @param float $lng Longitude (single point)
     * @param string $locations Pipe-separated lng,lat pairs (batch)
     * @param string $outputFields Comma-separated property fields to include
     * @param string $outputInclude Extra computed fields: bbox, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function lookupPost(
        ?string $format = null,
        ?float $lat = null,
        ?float $lng = null,
        ?string $locations = null,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationLookupResult;

    /**
     * @api
     *
     * @param list<\Plaza\Elevation\ElevationProfileParams\Coordinate|CoordinateShape1> $coordinates Path coordinates in order of travel (min 2, max 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function profile(
        array $coordinates,
        RequestOptions|array|null $requestOptions = null
    ): ElevationProfileResult;
}
