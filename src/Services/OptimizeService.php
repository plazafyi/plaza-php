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
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\OptimizeContract;

/**
 * @phpstan-import-type MultiPointGeometryShape from \Plaza\PlazaClientService\MultiPointGeometry
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
    ): OptimizeCompletedResult|OptimizeProcessingResult {
        $params = Util::removeNulls(
            [
                'waypoints' => $waypoints,
                'format' => $format,
                'mode' => $mode,
                'roundtrip' => $roundtrip,
            ],
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
