<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Optimize\OptimizeCompletedResult;
use Plaza\Optimize\OptimizeCreateParams\Mode;
use Plaza\Optimize\OptimizeJobStatus;
use Plaza\Optimize\OptimizeProcessingResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\OptimizeContract;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
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
