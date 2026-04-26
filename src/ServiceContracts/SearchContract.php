<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface SearchContract
{
    /**
     * @api
     *
     * @param string $q Search query string
     * @param string $cursor Cursor for pagination
     * @param string $format Response format: json (default), geojson, csv, ndjson
     * @param int $limit Maximum results (default 25, max 100)
     * @param string $outputFields Comma-separated property fields to include
     * @param string $outputInclude Extra computed fields: bbox, distance, center
     * @param int $outputPrecision Coordinate decimal precision (1-15, default 7)
     * @param string $outputSort Sort by: distance, name, osm_id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function query(
        string $q,
        ?string $cursor = null,
        ?string $format = null,
        ?int $limit = null,
        ?string $outputFields = null,
        ?string $outputInclude = null,
        ?int $outputPrecision = null,
        ?string $outputSort = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection;
}
