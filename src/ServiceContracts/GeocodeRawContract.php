<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Geocode\AutocompleteResult;
use Plaza\Geocode\GeocodeAutocompleteParams;
use Plaza\Geocode\GeocodeBatchParams;
use Plaza\Geocode\GeocodeForwardParams;
use Plaza\Geocode\GeocodeResult;
use Plaza\Geocode\GeocodeReverseParams;
use Plaza\Geocode\ReverseGeocodeResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface GeocodeRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|GeocodeAutocompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutocompleteResult>
     *
     * @throws APIException
     */
    public function autocomplete(
        array|GeocodeAutocompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|GeocodeBatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function batch(
        array|GeocodeBatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|GeocodeForwardParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeocodeResult>
     *
     * @throws APIException
     */
    public function forward(
        array|GeocodeForwardParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|GeocodeReverseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReverseGeocodeResult>
     *
     * @throws APIException
     */
    public function reverse(
        array|GeocodeReverseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
