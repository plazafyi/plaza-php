<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Optimize\OptimizeCompletedResult;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeCreateParams\Waypoint;
use Plaza\Optimize\OptimizeJobStatus;
use Plaza\Optimize\OptimizeProcessingResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\OptimizeContract;

/**
 * @phpstan-import-type WaypointShape from \Plaza\Optimize\OptimizeCreateParams\Waypoint
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class OptimizeService implements OptimizeContract
{
    /**
     * @api
     */
    public OptimizeRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OptimizeRawService($client);
    }

    /**
     * @api
     *
     * Optimize route through waypoints
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
    ): OptimizeCompletedResult|OptimizeProcessingResult {
        $params = Util::removeNulls(
            ['waypoints' => $waypoints, 'mode' => $mode, 'roundtrip' => $roundtrip]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get async optimization result
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $jobID,
        RequestOptions|array|null $requestOptions = null
    ): OptimizeJobStatus {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($jobID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
