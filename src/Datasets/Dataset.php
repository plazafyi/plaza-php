<?php

declare(strict_types=1);

namespace Plaza\Datasets;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Datasets\Dataset\Scope;
use Plaza\Datasets\Dataset\Status;

/**
 * Metadata for a custom dataset. Datasets contain user-uploaded geospatial features separate from the OSM data.
 *
 * @phpstan-type DatasetShape = array{
 *   id: string,
 *   insertedAt: \DateTimeInterface,
 *   name: string,
 *   scope: Scope|value-of<Scope>,
 *   slug: string,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   addressCount?: int|null,
 *   attribution?: string|null,
 *   description?: string|null,
 *   edgeCount?: int|null,
 *   errorMessage?: string|null,
 *   featureCount?: int|null,
 *   license?: string|null,
 *   schemaDefinition?: mixed,
 *   sourceFormat?: string|null,
 *   sourceURL?: string|null,
 *   storageBytes?: int|null,
 *   strictMode?: bool|null,
 * }
 */
final class Dataset implements BaseModel
{
    /** @use SdkModel<DatasetShape> */
    use SdkModel;

    /**
     * Dataset UUID.
     */
    #[Required]
    public string $id;

    /**
     * Creation timestamp (UTC).
     */
    #[Required('inserted_at')]
    public \DateTimeInterface $insertedAt;

    /**
     * Human-readable dataset name.
     */
    #[Required]
    public string $name;

    /**
     * Dataset scope: plaza (managed by Plaza) or user (user-owned).
     *
     * @var value-of<Scope> $scope
     */
    #[Required(enum: Scope::class)]
    public string $scope;

    /**
     * URL-friendly identifier.
     */
    #[Required]
    public string $slug;

    /**
     * Current processing status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Last update timestamp (UTC).
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Number of addresses in this dataset.
     */
    #[Optional('address_count')]
    public ?int $addressCount;

    /**
     * Required attribution text.
     */
    #[Optional(nullable: true)]
    public ?string $attribution;

    /**
     * Dataset description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Number of routing edges in this dataset.
     */
    #[Optional('edge_count')]
    public ?int $edgeCount;

    /**
     * Error message if status is 'error'.
     */
    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    /**
     * Number of features in this dataset.
     */
    #[Optional('feature_count')]
    public ?int $featureCount;

    /**
     * License identifier (e.g. CC-BY-4.0).
     */
    #[Optional(nullable: true)]
    public ?string $license;

    /**
     * Detected or user-defined property schema.
     */
    #[Optional('schema_definition', nullable: true)]
    public mixed $schemaDefinition;

    /**
     * Data format (geojson).
     */
    #[Optional('source_format', nullable: true)]
    public ?string $sourceFormat;

    /**
     * URL of the original data source.
     */
    #[Optional('source_url', nullable: true)]
    public ?string $sourceURL;

    /**
     * Total storage consumed in bytes.
     */
    #[Optional('storage_bytes')]
    public ?int $storageBytes;

    /**
     * Whether strict schema validation is enabled.
     */
    #[Optional('strict_mode')]
    public ?bool $strictMode;

    /**
     * `new Dataset()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Dataset::with(
     *   id: ...,
     *   insertedAt: ...,
     *   name: ...,
     *   scope: ...,
     *   slug: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Dataset)
     *   ->withID(...)
     *   ->withInsertedAt(...)
     *   ->withName(...)
     *   ->withScope(...)
     *   ->withSlug(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
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
     * @param Scope|value-of<Scope> $scope
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        \DateTimeInterface $insertedAt,
        string $name,
        Scope|string $scope,
        string $slug,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        ?int $addressCount = null,
        ?string $attribution = null,
        ?string $description = null,
        ?int $edgeCount = null,
        ?string $errorMessage = null,
        ?int $featureCount = null,
        ?string $license = null,
        mixed $schemaDefinition = null,
        ?string $sourceFormat = null,
        ?string $sourceURL = null,
        ?int $storageBytes = null,
        ?bool $strictMode = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['insertedAt'] = $insertedAt;
        $self['name'] = $name;
        $self['scope'] = $scope;
        $self['slug'] = $slug;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        null !== $addressCount && $self['addressCount'] = $addressCount;
        null !== $attribution && $self['attribution'] = $attribution;
        null !== $description && $self['description'] = $description;
        null !== $edgeCount && $self['edgeCount'] = $edgeCount;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $featureCount && $self['featureCount'] = $featureCount;
        null !== $license && $self['license'] = $license;
        null !== $schemaDefinition && $self['schemaDefinition'] = $schemaDefinition;
        null !== $sourceFormat && $self['sourceFormat'] = $sourceFormat;
        null !== $sourceURL && $self['sourceURL'] = $sourceURL;
        null !== $storageBytes && $self['storageBytes'] = $storageBytes;
        null !== $strictMode && $self['strictMode'] = $strictMode;

        return $self;
    }

    /**
     * Dataset UUID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Creation timestamp (UTC).
     */
    public function withInsertedAt(\DateTimeInterface $insertedAt): self
    {
        $self = clone $this;
        $self['insertedAt'] = $insertedAt;

        return $self;
    }

    /**
     * Human-readable dataset name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Dataset scope: plaza (managed by Plaza) or user (user-owned).
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * URL-friendly identifier.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Current processing status.
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
     * Last update timestamp (UTC).
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Number of addresses in this dataset.
     */
    public function withAddressCount(int $addressCount): self
    {
        $self = clone $this;
        $self['addressCount'] = $addressCount;

        return $self;
    }

    /**
     * Required attribution text.
     */
    public function withAttribution(?string $attribution): self
    {
        $self = clone $this;
        $self['attribution'] = $attribution;

        return $self;
    }

    /**
     * Dataset description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Number of routing edges in this dataset.
     */
    public function withEdgeCount(int $edgeCount): self
    {
        $self = clone $this;
        $self['edgeCount'] = $edgeCount;

        return $self;
    }

    /**
     * Error message if status is 'error'.
     */
    public function withErrorMessage(?string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    /**
     * Number of features in this dataset.
     */
    public function withFeatureCount(int $featureCount): self
    {
        $self = clone $this;
        $self['featureCount'] = $featureCount;

        return $self;
    }

    /**
     * License identifier (e.g. CC-BY-4.0).
     */
    public function withLicense(?string $license): self
    {
        $self = clone $this;
        $self['license'] = $license;

        return $self;
    }

    /**
     * Detected or user-defined property schema.
     */
    public function withSchemaDefinition(mixed $schemaDefinition): self
    {
        $self = clone $this;
        $self['schemaDefinition'] = $schemaDefinition;

        return $self;
    }

    /**
     * Data format (geojson).
     */
    public function withSourceFormat(?string $sourceFormat): self
    {
        $self = clone $this;
        $self['sourceFormat'] = $sourceFormat;

        return $self;
    }

    /**
     * URL of the original data source.
     */
    public function withSourceURL(?string $sourceURL): self
    {
        $self = clone $this;
        $self['sourceURL'] = $sourceURL;

        return $self;
    }

    /**
     * Total storage consumed in bytes.
     */
    public function withStorageBytes(int $storageBytes): self
    {
        $self = clone $this;
        $self['storageBytes'] = $storageBytes;

        return $self;
    }

    /**
     * Whether strict schema validation is enabled.
     */
    public function withStrictMode(bool $strictMode): self
    {
        $self = clone $this;
        $self['strictMode'] = $strictMode;

        return $self;
    }
}
