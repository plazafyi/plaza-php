<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElevationContract;

/**
 * @phpstan-import-type GeometryShape from \Plaza\Elevation\ElevationLookupParams\Geometry
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
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
     * Look up elevation at one or more points
     *
     * @param GeometryShape $geometry Body param: Point or MultiPoint geometry to look up elevations for
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function lookup(
        PointGeometry|array|MultiPointGeometry $geometry,
        ?string $format = null,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationLookupResult {
        $params = Util::removeNulls(['geometry' => $geometry, 'format' => $format]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->lookup(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Elevation profile along coordinates
     *
     * @param LineStringGeometry|LineStringGeometryShape $geometry GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function profile(
        LineStringGeometry|array $geometry,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationProfileResult {
        $params = Util::removeNulls(['geometry' => $geometry]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->profile(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
