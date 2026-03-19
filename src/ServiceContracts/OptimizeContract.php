<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Optimize\OptimizeCompletedResult;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeJobStatus;
use Plaza\Optimize\OptimizeProcessingResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface OptimizeContract
{
    /**
     * @api
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $waypoints Waypoints to visit (GeoJSON MultiPoint geometry, minimum 2 points)
     * @param Mode|value-of<Mode> $mode Travel mode (default: auto)
     * @param bool $roundtrip Whether route returns to start (default: true)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        GeoJsonGeometry|array $waypoints,
        Mode|string|null $mode = null,
        ?bool $roundtrip = null,
        RequestOptions|array|null $requestOptions = null,
    ): OptimizeCompletedResult|OptimizeProcessingResult;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): OptimizeJobStatus;
}
