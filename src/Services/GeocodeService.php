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
use Plaza\RequestOptions;
use Plaza\ServiceContracts\GeocodeContract;

/**
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
     * @param string $q Partial address query
     * @param string $countryCode ISO 3166-1 alpha-2 country code filter
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param float $lat Focus latitude
     * @param string $layer Filter by layer: address, poi, or admin
     * @param int $limit Maximum results (default 10, max 20)
     * @param float $lng Focus longitude
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function autocomplete(
        string $q,
        ?string $countryCode = null,
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutocompleteResult {
        $params = Util::removeNulls(
            [
                'q' => $q,
                'countryCode' => $countryCode,
                'lang' => $lang,
                'lat' => $lat,
                'layer' => $layer,
                'limit' => $limit,
                'lng' => $lng,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->autocomplete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Autocomplete a partial address
     *
     * @param string $q Partial address query
     * @param string $countryCode ISO 3166-1 alpha-2 country code filter
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param float $lat Focus latitude
     * @param string $layer Filter by layer: address, poi, or admin
     * @param int $limit Maximum results (default 10, max 20)
     * @param float $lng Focus longitude
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function autocompletePost(
        string $q,
        ?string $countryCode = null,
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutocompleteResult {
        $params = Util::removeNulls(
            [
                'q' => $q,
                'countryCode' => $countryCode,
                'lang' => $lang,
                'lat' => $lat,
                'layer' => $layer,
                'limit' => $limit,
                'lng' => $lng,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->autocompletePost(params: $params, requestOptions: $requestOptions);

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
     * @param string $q Address or place name
     * @param string $bbox Bounding box filter: south,west,north,east
     * @param string $countryCode ISO 3166-1 alpha-2 country code filter
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param float $lat Focus latitude
     * @param string $layer Filter by layer: address, poi, or admin
     * @param int $limit Maximum results (default 20, max 100)
     * @param float $lng Focus longitude
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function forward(
        string $q,
        ?string $bbox = null,
        ?string $countryCode = null,
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        RequestOptions|array|null $requestOptions = null,
    ): GeocodeResult {
        $params = Util::removeNulls(
            [
                'q' => $q,
                'bbox' => $bbox,
                'countryCode' => $countryCode,
                'lang' => $lang,
                'lat' => $lat,
                'layer' => $layer,
                'limit' => $limit,
                'lng' => $lng,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->forward(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Forward geocode an address
     *
     * @param string $q Address or place name
     * @param string $bbox Bounding box filter: south,west,north,east
     * @param string $countryCode ISO 3166-1 alpha-2 country code filter
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param float $lat Focus latitude
     * @param string $layer Filter by layer: address, poi, or admin
     * @param int $limit Maximum results (default 20, max 100)
     * @param float $lng Focus longitude
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function forwardPost(
        string $q,
        ?string $bbox = null,
        ?string $countryCode = null,
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        RequestOptions|array|null $requestOptions = null,
    ): GeocodeResult {
        $params = Util::removeNulls(
            [
                'q' => $q,
                'bbox' => $bbox,
                'countryCode' => $countryCode,
                'lang' => $lang,
                'lat' => $lat,
                'layer' => $layer,
                'limit' => $limit,
                'lng' => $lng,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->forwardPost(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Reverse geocode a coordinate
     *
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param float $lat Legacy shorthand. Latitude. Use near param instead.
     * @param string $layer Filter by layer: house or poi
     * @param int $limit Maximum results (default 1, max 20)
     * @param float $lng Legacy shorthand. Longitude. Use near param instead.
     * @param string $near Point geometry for reverse geocode (lat,lng or GeoJSON). Alternative to lat/lng params.
     * @param int $radius Search radius in meters (default 200, max 5000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reverse(
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        ?string $near = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): ReverseGeocodeResult {
        $params = Util::removeNulls(
            [
                'lang' => $lang,
                'lat' => $lat,
                'layer' => $layer,
                'limit' => $limit,
                'lng' => $lng,
                'near' => $near,
                'radius' => $radius,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reverse(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Reverse geocode a coordinate
     *
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param float $lat Legacy shorthand. Latitude. Use near param instead.
     * @param string $layer Filter by layer: house or poi
     * @param int $limit Maximum results (default 1, max 20)
     * @param float $lng Legacy shorthand. Longitude. Use near param instead.
     * @param string $near Point geometry for reverse geocode (lat,lng or GeoJSON). Alternative to lat/lng params.
     * @param int $radius Search radius in meters (default 200, max 5000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reversePost(
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
        ?string $near = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): ReverseGeocodeResult {
        $params = Util::removeNulls(
            [
                'lang' => $lang,
                'lat' => $lat,
                'layer' => $layer,
                'limit' => $limit,
                'lng' => $lng,
                'near' => $near,
                'radius' => $radius,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reversePost(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
