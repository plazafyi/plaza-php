<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Geocode\AutocompleteResult;
use Plaza\Geocode\GeocodeAutocompleteParams;
use Plaza\Geocode\GeocodeBatchParams;
use Plaza\Geocode\GeocodeBatchResponse;
use Plaza\Geocode\GeocodeForwardParams;
use Plaza\Geocode\GeocodeResult;
use Plaza\Geocode\GeocodeReverseParams;
use Plaza\Geocode\ReverseGeocodeResult;
use Plaza\PlazaClientService\PointGeometry;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\GeocodeRawContract;

/**
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
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
     *   format?: string,
     *   countryCode?: string|null,
     *   focus?: PointGeometry|PointGeometryShape|null,
     *   lang?: string|null,
     *   layer?: string|null,
     *   limit?: int|null,
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
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode/autocomplete',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
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
     *   format?: string,
     *   countryCode?: string|null,
     *   focus?: PointGeometry|PointGeometryShape|null,
     *   lang?: string|null,
     *   layer?: string|null,
     *   limit?: int|null,
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
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
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
     *   geometry: PointGeometry|PointGeometryShape,
     *   format?: string,
     *   lang?: string|null,
     *   limit?: int|null,
     *   radius?: float|null,
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
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/geocode/reverse',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: ReverseGeocodeResult::class,
        );
    }
}
