<?php

declare(strict_types=1);

namespace Plaza\PlazaClientService;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\FeatureCollection\Type;

/**
 * GeoJSON FeatureCollection (RFC 7946). For paginated endpoints, metadata is returned in HTTP response headers rather than the body:
 *
 * | Header | Description |
 * |---|---|
 * | `X-Limit` | Requested result limit |
 * | `X-Has-More` | `true` if more results exist |
 * | `X-Next-Cursor` | Opaque cursor for next page (cursor pagination) |
 * | `X-Next-Offset` | Numeric offset for next page (offset pagination) |
 * | `Link` | RFC 8288 `rel="next"` link to the next page |
 *
 * Content-Type is `application/geo+json`.
 *
 * @phpstan-import-type GeoJsonFeatureShape from \Plaza\PlazaClientService\GeoJsonFeature
 *
 * @phpstan-type FeatureCollectionShape = array{
 *   features: list<GeoJsonFeature|GeoJsonFeatureShape>, type: Type|value-of<Type>
 * }
 */
final class FeatureCollection implements BaseModel
{
    /** @use SdkModel<FeatureCollectionShape> */
    use SdkModel;

    /**
     * Array of GeoJSON Feature objects.
     *
     * @var list<GeoJsonFeature> $features
     */
    #[Required(list: GeoJsonFeature::class)]
    public array $features;

    /**
     * Always `FeatureCollection`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new FeatureCollection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeatureCollection::with(features: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeatureCollection)->withFeatures(...)->withType(...)
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
     * @param list<GeoJsonFeature|GeoJsonFeatureShape> $features
     * @param Type|value-of<Type> $type
     */
    public static function with(array $features, Type|string $type): self
    {
        $self = new self;

        $self['features'] = $features;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Array of GeoJSON Feature objects.
     *
     * @param list<GeoJsonFeature|GeoJsonFeatureShape> $features
     */
    public function withFeatures(array $features): self
    {
        $self = clone $this;
        $self['features'] = $features;

        return $self;
    }

    /**
     * Always `FeatureCollection`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
