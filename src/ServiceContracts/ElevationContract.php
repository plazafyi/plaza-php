<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileResult;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\PlazaClientService\MultiPointGeometry;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type GeometryShape from \Plaza\Elevation\ElevationLookupParams\Geometry
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface ElevationContract
{
    /**
     * @api
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
    ): ElevationLookupResult;

    /**
     * @api
     *
     * @param LineStringGeometry|LineStringGeometryShape $geometry GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function profile(
        LineStringGeometry|array $geometry,
        RequestOptions|array|null $requestOptions = null,
    ): ElevationProfileResult;
}
