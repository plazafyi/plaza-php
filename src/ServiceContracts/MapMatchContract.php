<?php

declare(strict_types=1);

namespace Plaza\ServiceContracts;

use Plaza\Core\Exceptions\APIException;
use Plaza\MapMatch\MapMatchMatchParams\Coordinate;
use Plaza\MapMatch\MapMatchResult;
use Plaza\RequestOptions;

/**
 * @phpstan-import-type CoordinateShape from \Plaza\MapMatch\MapMatchMatchParams\Coordinate
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
interface MapMatchContract
{
    /**
     * @api
     *
     * @param list<Coordinate|CoordinateShape> $coordinates GPS coordinates to match, in order of travel (max 50 points)
     * @param list<float>|null $radiuses Search radius per coordinate in meters. Must have the same length as `coordinates` or be omitted entirely. Default: 50m per point.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
        array $coordinates,
        ?array $radiuses = null,
        RequestOptions|array|null $requestOptions = null,
    ): MapMatchResult;
}
