<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\MapMatch\MapMatchResult;
use Plaza\PlazaClientService\GeoJsonGeometry;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface MapMatchContract
{
    /**
     * @api
     *
     * @param GeoJsonGeometry|GeoJsonGeometryShape $trace GPS trace (GeoJSON LineString geometry)
     * @param list<float>|null $radiuses Search radius per coordinate in meters (optional, default 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
        GeoJsonGeometry|array $trace,
        ?array $radiuses = null,
        RequestOptions|array|null $requestOptions = null,
    ): MapMatchResult;
}
