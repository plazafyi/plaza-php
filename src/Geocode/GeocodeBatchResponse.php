<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * Batch geocoding result. Each entry in `results` is a FeatureCollection corresponding to the input address at the same index. Order is preserved.
 *
 * @phpstan-import-type GeocodeResultShape from \Plaza\Geocode\GeocodeResult
 *
 * @phpstan-type GeocodeBatchResponseShape = array{
 *   count: int, results: list<GeocodeResult|GeocodeResultShape>
 * }
 */
final class GeocodeBatchResponse implements BaseModel
{
    /** @use SdkModel<GeocodeBatchResponseShape> */
    use SdkModel;

    /**
     * Number of addresses processed (always equals length of results).
     */
    #[Required]
    public int $count;

    /**
     * Array of FeatureCollections, one per input address. Empty FeatureCollections indicate no match.
     *
     * @var list<GeocodeResult> $results
     */
    #[Required(list: GeocodeResult::class)]
    public array $results;

    /**
     * `new GeocodeBatchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeBatchResponse::with(count: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeBatchResponse)->withCount(...)->withResults(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<GeocodeResult|GeocodeResultShape> $results
     */
    public static function with(int $count, array $results): self
    {
        $self = new self;

        $self['count'] = $count;
        $self['results'] = $results;

        return $self;
    }

    /**
     * Number of addresses processed (always equals length of results).
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * Array of FeatureCollections, one per input address. Empty FeatureCollections indicate no match.
     *
     * @param list<GeocodeResult|GeocodeResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
