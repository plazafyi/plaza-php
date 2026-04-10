<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\MapMatch\MapMatchResult;
use Plaza\PlazaClientService\LineStringGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type LineStringGeometryShape from \Plaza\PlazaClientService\LineStringGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface MapMatchContract
{
    /**
     * @api
     *
     * @param LineStringGeometry|LineStringGeometryShape $geometry GeoJSON LineString geometry per RFC 7946. An ordered sequence of two or more positions.
     * @param list<float>|null $radiuses Search radius per coordinate in meters. Must have the same length as the geometry coordinates or be omitted entirely. Default: 50m per point.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
        LineStringGeometry|array $geometry,
        ?array $radiuses = null,
        RequestOptions|array|null $requestOptions = null,
    ): MapMatchResult;
}
