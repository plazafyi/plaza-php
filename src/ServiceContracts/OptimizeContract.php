<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Optimize\OptimizeCompletedResult;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeCreateParams\Waypoint;
use Plaza\Optimize\OptimizeJobStatus;
use Plaza\Optimize\OptimizeProcessingResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type WaypointShape from \Plaza\Optimize\OptimizeCreateParams\Waypoint
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface OptimizeContract
{
    /**
     * @api
     *
     * @param list<Waypoint|WaypointShape> $waypoints Waypoints to visit in optimized order (2-50 points)
     * @param Mode|value-of<Mode> $mode Travel mode (default: `auto`)
     * @param bool $roundtrip Whether the route should return to the starting waypoint (default: true)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $waypoints,
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
