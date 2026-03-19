<?php

declare(strict_types=1);

namespace Plaza\Services;

use Plaza\Client;
use Plaza\Core\Exceptions\APIException;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\RequestOptions;
use Plaza\ServiceContracts\SearchContract;

/**
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
final class SearchService implements SearchContract
{
    /**
     * @api
     */
    public SearchRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SearchRawService($client);
    }

    /**
     * @api
     *
     * Search OSM features by name
     *
     * @param string $q Search query string
     * @param string $cursor Cursor for pagination
     * @param int $limit Maximum results (default 25, max 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function query(
        string $q,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): FeatureCollection {
        $params = Util::removeNulls(
            ['q' => $q, 'cursor' => $cursor, 'limit' => $limit]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->query(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
