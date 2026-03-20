<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\Geocode\AutocompleteResult;
use Plaza\Geocode\GeocodeAutocompleteParams;
use Plaza\Geocode\GeocodeAutocompletePostParams;
use Plaza\Geocode\GeocodeBatchParams;
use Plaza\Geocode\GeocodeBatchResponse;
use Plaza\Geocode\GeocodeForwardParams;
use Plaza\Geocode\GeocodeForwardPostParams;
use Plaza\Geocode\GeocodeResult;
use Plaza\Geocode\GeocodeReverseParams;
use Plaza\Geocode\GeocodeReversePostParams;
use Plaza\Geocode\ReverseGeocodeResult;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\GeocodeRawContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class GeocodeRawService implements GeocodeRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Autocomplete a partial address
     *
     * @param array{
     *   q: string,
     *   countryCode?: string,
     *   format?: string,
     *   lang?: string,
     *   lat?: float,
     *   layer?: string,
     *   limit?: int,
     *   lng?: float,
     * }|GeocodeAutocompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutocompleteResult>
     *
     * @throws APIException
     */
    public function autocomplete(
        array|GeocodeAutocompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeAutocompleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/geocode/autocomplete',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code']
            ),
            options: $options,
            convert: AutocompleteResult::class,
        );
    }

    /**
     * @api
     *
     * Autocomplete a partial address
     *
     * @param array{
     *   q: string,
     *   countryCode?: string,
     *   format?: string,
     *   lang?: string,
     *   lat?: float,
     *   layer?: string,
     *   limit?: int,
     *   lng?: float,
     * }|GeocodeAutocompletePostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutocompleteResult>
     *
     * @throws APIException
     */
    public function autocompletePost(
        array|GeocodeAutocompletePostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeAutocompletePostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode/autocomplete',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code']
            ),
            options: $options,
            convert: AutocompleteResult::class,
        );
    }

    /**
     * @api
     *
     * Batch geocode multiple addresses
     *
     * @param array{addresses: list<string>}|GeocodeBatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeocodeBatchResponse>
     *
     * @throws APIException
     */
    public function batch(
        array|GeocodeBatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeBatchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode/batch',
            body: (object) $parsed,
            options: $options,
            convert: GeocodeBatchResponse::class,
        );
    }

    /**
     * @api
     *
     * Forward geocode an address
     *
     * @param array{
     *   q: string,
     *   bbox?: string,
     *   countryCode?: string,
     *   format?: string,
     *   lang?: string,
     *   lat?: float,
     *   layer?: string,
     *   limit?: int,
     *   lng?: float,
     * }|GeocodeForwardParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeocodeResult>
     *
     * @throws APIException
     */
    public function forward(
        array|GeocodeForwardParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeForwardParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/geocode',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code']
            ),
            options: $options,
            convert: GeocodeResult::class,
        );
    }

    /**
     * @api
     *
     * Forward geocode an address
     *
     * @param array{
     *   q: string,
     *   bbox?: string,
     *   countryCode?: string,
     *   format?: string,
     *   lang?: string,
     *   lat?: float,
     *   layer?: string,
     *   limit?: int,
     *   lng?: float,
     * }|GeocodeForwardPostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeocodeResult>
     *
     * @throws APIException
     */
    public function forwardPost(
        array|GeocodeForwardPostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeForwardPostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode',
            query: Util::array_transform_keys(
                $parsed,
                ['countryCode' => 'country_code']
            ),
            options: $options,
            convert: GeocodeResult::class,
        );
    }

    /**
     * @api
     *
     * Reverse geocode a coordinate
     *
     * @param array{
     *   format?: string,
     *   lang?: string,
     *   lat?: float,
     *   layer?: string,
     *   limit?: int,
     *   lng?: float,
     *   near?: string,
     *   radius?: int,
     * }|GeocodeReverseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReverseGeocodeResult>
     *
     * @throws APIException
     */
    public function reverse(
        array|GeocodeReverseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeReverseParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/geocode/reverse',
            query: $parsed,
            options: $options,
            convert: ReverseGeocodeResult::class,
        );
    }

    /**
     * @api
     *
     * Reverse geocode a coordinate
     *
     * @param array{
     *   format?: string,
     *   lang?: string,
     *   lat?: float,
     *   layer?: string,
     *   limit?: int,
     *   lng?: float,
     *   near?: string,
     *   radius?: int,
     * }|GeocodeReversePostParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReverseGeocodeResult>
     *
     * @throws APIException
     */
    public function reversePost(
        array|GeocodeReversePostParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GeocodeReversePostParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode/reverse',
            query: $parsed,
            options: $options,
            convert: ReverseGeocodeResult::class,
        );
    }
}
