<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Elements\ElementBatchParams;
use Plaza\Elements\ElementBatchParams\Element;
use Plaza\Elements\ElementNearbyParams;
use Plaza\Elements\ElementQueryParams;
use Plaza\Elements\ElementRetrieveParams;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\ElementsRawContract;

/**
 * @phpstan-import-type ElementShape from \Plaza\Elements\ElementBatchParams\Element
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class ElementsRawService implements ElementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get feature by type and ID
     *
     * @param int $id OSM ID
     * @param array{type: string}|ElementRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeoJsonFeature>
     *
     * @throws APIException
     */
    public function retrieve(
        int $id,
        array|ElementRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElementRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $type = $parsed['type'];
        unset($parsed['type']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/features/%1$s/%2$s', $type, $id],
            headers: ['Accept' => 'application/geo+json'],
            options: $options,
            convert: GeoJsonFeature::class,
        );
    }

    /**
     * @api
     *
     * Fetch multiple features by type and ID
     *
     * @param array{elements: list<Element|ElementShape>}|ElementBatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function batch(
        array|ElementBatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElementBatchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/features/batch',
            headers: ['Accept' => 'application/geo+json'],
            body: (object) $parsed,
            options: $options,
            convert: FeatureCollection::class,
        );
    }

    /**
     * @api
     *
     * Find features near a geographic point
     *
     * @param array{
     *   lat: float, lng: float, limit?: int, radius?: int
     * }|ElementNearbyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function nearby(
        array|ElementNearbyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElementNearbyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/features/nearby',
            query: $parsed,
            headers: ['Accept' => 'application/geo+json'],
            options: $options,
            convert: FeatureCollection::class,
        );
    }

    /**
     * @api
     *
     * Query features by bounding box or H3 cell
     *
     * @param array{
     *   bbox?: string, cursor?: string, h3?: string, limit?: int, type?: string
     * }|ElementQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function query(
        array|ElementQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ElementQueryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/features',
            query: $parsed,
            headers: ['Accept' => 'application/geo+json'],
            options: $options,
            convert: FeatureCollection::class,
        );
    }
}
