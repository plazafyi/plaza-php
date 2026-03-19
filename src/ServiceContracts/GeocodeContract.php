<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\Geocode\AutocompleteResult;
use Plaza\Geocode\GeocodeResult;
use Plaza\Geocode\ReverseGeocodeResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface GeocodeContract
{
    /**
     * @api
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
    ): AutocompleteResult;

    /**
     * @api
     *
     * @param list<string> $addresses
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function batch(
        array $addresses,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): GeocodeResult;

    /**
     * @api
     *
     * @param float $lat Latitude
     * @param float $lng Longitude
     * @param string $lang Language code for localized names (e.g. en, de, fr)
     * @param string $layer Filter by layer: house or poi
     * @param int $limit Maximum results (default 1, max 20)
     * @param int $radius Search radius in meters (default 200, max 5000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reverse(
        float $lat,
        float $lng,
        ?string $lang = null,
        ?string $layer = null,
        ?int $limit = null,
        ?int $radius = null,
        RequestOptions|array|null $requestOptions = null,
    ): ReverseGeocodeResult;
}
