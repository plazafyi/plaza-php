<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Contracts\BaseResponse;
use Plaza\Core\Exceptions\APIException;
use Plaza\Features\FeatureBatchParams;
use Plaza\Features\FeatureBatchParams\Element;
use Plaza\Features\FeatureQueryParams;
use Plaza\Features\FeatureRetrieveParams;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\FeaturesRawContract;

/**
 * @phpstan-import-type ElementShape from \Plaza\Features\FeatureBatchParams\Element
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 * @phpstan-import-type GeometryShape from \Plaza\PlazaClientService\Geometry
 */
final class FeaturesRawService implements FeaturesRawContract
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
     * @param array{type: string}|FeatureRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GeoJsonFeature>
     *
     * @throws APIException
     */
    public function retrieve(
        int $id,
        array|FeatureRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FeatureRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $type = $parsed['type'];
        unset($parsed['type']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/features/%1$s/%2$s', $type, $id],
            options: $options,
            convert: GeoJsonFeature::class,
        );
    }

    /**
     * @api
     *
     * Fetch multiple features by type and ID
     *
     * @param array{elements: list<Element|ElementShape>}|FeatureBatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function batch(
        array|FeatureBatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FeatureBatchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/features/batch',
            body: (object) $parsed,
            options: $options,
            convert: FeatureCollection::class,
        );
    }

    /**
     * @api
     *
     * Query features by spatial predicate, bounding box, or H3 cell
     *
     * @param array{
     *   cursor?: string,
     *   format?: string,
     *   h3?: string,
     *   limit?: int,
     *   type?: string,
     *   around?: GeometryShape,
     *   contains?: GeometryShape,
     *   crosses?: GeometryShape,
     *   intersects?: GeometryShape,
     *   notContains?: GeometryShape,
     *   notIntersects?: GeometryShape,
     *   notWithin?: GeometryShape,
     *   radius?: float,
     *   touches?: GeometryShape,
     *   within?: GeometryShape,
     * }|FeatureQueryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FeatureCollection>
     *
     * @throws APIException
     */
    public function query(
        array|FeatureQueryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FeatureQueryParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['cursor', 'format', 'h3', 'limit', 'type']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/features',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: FeatureCollection::class,
        );
    }
}
