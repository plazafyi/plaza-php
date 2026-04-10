<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Geocode\AutocompleteResult;
use Plaza\Geocode\GeocodeBatchResponse;
use Plaza\Geocode\GeocodeResult;
use Plaza\Geocode\ReverseGeocodeResult;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\GeocodeContract;

/**
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class GeocodeService implements GeocodeContract
{
    /**
     * @api
     */
    public GeocodeRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new GeocodeRawService($client);
    }

    /**
     * @api
     *
     * Autocomplete a partial address
     *
     * @param string $q Body param: Partial address or place name input
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param string|null $countryCode Body param: ISO 3166-1 alpha-2 country code to restrict results
     * @param PointGeometry|PointGeometryShape|null $focus Body param: GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param string|null $lang Body param: Preferred response language (ISO 639-1)
     * @param string|null $layer Body param: Filter by result layer (e.g. `address`, `place`, `poi`)
     * @param int|null $limit Body param: Maximum number of suggestions (default: 5, max: 20)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function autocomplete(
        string $q,
        ?string $format = null,
        ?string $countryCode = null,
        PointGeometry|array|null $focus = null,
        ?string $lang = null,
        ?string $layer = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutocompleteResult {
        $params = Util::removeNulls(
            [
                'q' => $q,
                'format' => $format,
                'countryCode' => $countryCode,
                'focus' => $focus,
                'lang' => $lang,
                'layer' => $layer,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->autocomplete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Batch geocode multiple addresses
     *
     * @param list<string> $addresses
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        array $addresses,
        RequestOptions|array|null $requestOptions = null
    ): GeocodeBatchResponse {
        $params = Util::removeNulls(['addresses' => $addresses]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->batch(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forward geocode an address
     *
     * @param string $q Body param: Address or place name to geocode
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param string|null $countryCode Body param: ISO 3166-1 alpha-2 country code to restrict results
     * @param PointGeometry|PointGeometryShape|null $focus Body param: GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param string|null $lang Body param: Preferred response language (ISO 639-1)
     * @param string|null $layer Body param: Filter by result layer (e.g. `address`, `place`, `poi`)
     * @param int|null $limit Body param: Maximum number of results (default: 5, max: 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function forward(
        string $q,
        ?string $format = null,
        ?string $countryCode = null,
        PointGeometry|array|null $focus = null,
        ?string $lang = null,
        ?string $layer = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): GeocodeResult {
        $params = Util::removeNulls(
            [
                'q' => $q,
                'format' => $format,
                'countryCode' => $countryCode,
                'focus' => $focus,
                'lang' => $lang,
                'layer' => $layer,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->forward(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Reverse geocode a coordinate
     *
     * @param PointGeometry|PointGeometryShape $geometry Body param: GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     * @param string $format Query param: Response format: json (default), geojson, csv, ndjson
     * @param string|null $lang Body param: Preferred response language (ISO 639-1)
     * @param int|null $limit Body param: Maximum number of results (default: 1, max: 50)
     * @param float|null $radius Body param: Search radius in meters (default: 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reverse(
        PointGeometry|array $geometry,
        ?string $format = null,
        ?string $lang = null,
        ?int $limit = null,
        ?float $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): ReverseGeocodeResult {
        $params = Util::removeNulls(
            [
                'geometry' => $geometry,
                'format' => $format,
                'lang' => $lang,
                'limit' => $limit,
                'radius' => $radius,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reverse(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
