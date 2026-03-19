<?php

declare(strict_types=1);

namespace Plaza\Optimize;

use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Optimize\OptimizeCompletedResult\Properties;
use Plaza\Optimize\OptimizeCompletedResult\Status;
use Plaza\Optimize\OptimizeCompletedResult\Type;
use Plaza\PlazaClientService\GeoJsonGeometry;

/**
 * Completed optimization — GeoJSON Feature with optimized route.
 *
 * @phpstan-import-type GeoJsonGeometryShape from \Plaza\PlazaClientService\GeoJsonGeometry
 * @phpstan-import-type PropertiesShape from \Plaza\Optimize\OptimizeCompletedResult\Properties
 *
 * @phpstan-type OptimizeCompletedResultShape = array{
 *   geometry: GeoJsonGeometry|GeoJsonGeometryShape,
 *   properties: Properties|PropertiesShape,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class OptimizeCompletedResult implements BaseModel
{
    /** @use SdkModel<OptimizeCompletedResultShape> */
    use SdkModel;

    #[Required]
    public GeoJsonGeometry $geometry;

    #[Required]
    public Properties $properties;

    /**
     * Job status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new OptimizeCompletedResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OptimizeCompletedResult::with(
     *   geometry: ..., properties: ..., status: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OptimizeCompletedResult)
     *   ->withGeometry(...)
     *   ->withProperties(...)
     *   ->withStatus(...)
     *   ->withType(...)
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
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     * @param Properties|PropertiesShape $properties
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        GeoJsonGeometry|array $geometry,
        Properties|array $properties,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['geometry'] = $geometry;
        $self['properties'] = $properties;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param GeoJsonGeometry|GeoJsonGeometryShape $geometry
     */
    public function withGeometry(GeoJsonGeometry|array $geometry): self
    {
        $self = clone $this;
        $self['geometry'] = $geometry;

        return $self;
    }

    /**
     * @param Properties|PropertiesShape $properties
     */
    public function withProperties(Properties|array $properties): self
    {
        $self = clone $this;
        $self['properties'] = $properties;

        return $self;
    }

    /**
     * Job status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
