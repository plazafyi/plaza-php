<?php

declare(strict_types=1);

namespace Plaza\Query;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\Query\SparqlResult\Type;

/**
 * GeoJSON FeatureCollection of SPARQL query results.
 *
 * @phpstan-import-type GeoJsonFeatureShape from \Plaza\PlazaClientService\GeoJsonFeature
 *
 * @phpstan-type SparqlResultShape = array{
 *   features: list<GeoJsonFeature|GeoJsonFeatureShape>, type: Type|value-of<Type>
 * }
 */
final class SparqlResult implements BaseModel
{
    /** @use SdkModel<SparqlResultShape> */
    use SdkModel;

    /**
     * GeoJSON features from SPARQL query.
     *
     * @var list<GeoJsonFeature> $features
     */
    #[Required(list: GeoJsonFeature::class)]
    public array $features;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new SparqlResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SparqlResult::with(features: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SparqlResult)->withFeatures(...)->withType(...)
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
     * GeoJSON features from SPARQL query.
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
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
