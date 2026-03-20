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
     * @param list<Coordinate|CoordinateShape> $coordinates Coordinates to look up elevations for (max 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        array $coordinates,
        RequestOptions|array|null $requestOptions = null
    ): ElevationBatchResult;

    /**
     * @api
     *
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
