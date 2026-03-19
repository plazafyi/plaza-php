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
    ): FeatureCollection;
}
