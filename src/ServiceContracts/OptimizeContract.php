<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Optimize\OptimizeCompletedResult;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeJobStatus;
use Plaza\Optimize\OptimizeProcessingResult;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type MultiPointGeometryShape from \Plaza\PlazaClientService\MultiPointGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface OptimizeContract
{
    /**
     * @api
     *
     * @param MultiPointGeometry|MultiPointGeometryShape $waypoints Body param: GeoJSON MultiPoint geometry per RFC 7946. An array of positions.
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param Mode|value-of<Mode> $mode Body param: Travel mode (default: `auto`)
     * @param bool $roundtrip Body param: Whether the route should return to the starting waypoint (default: true)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        MultiPointGeometry|array $waypoints,
        ?string $format = null,
        Mode|string $mode = 'auto',
        bool $roundtrip = true,
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
