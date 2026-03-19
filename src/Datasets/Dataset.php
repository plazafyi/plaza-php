<?php

declare(strict_types=1);

namespace Plaza\Datasets;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type DatasetShape = array{
 *   id: string,
 *   insertedAt: \DateTimeInterface,
 *   name: string,
 *   slug: string,
 *   updatedAt: \DateTimeInterface,
 *   attribution?: string|null,
 *   description?: string|null,
 *   license?: string|null,
 *   sourceURL?: string|null,
 * }
 */
final class Dataset implements BaseModel
{
    /** @use SdkModel<DatasetShape> */
    use SdkModel;

    /**
     * Dataset ID.
     */
    #[Required]
    public string $id;

    /**
     * Creation timestamp.
     */
    #[Required('inserted_at')]
    public \DateTimeInterface $insertedAt;

    /**
     * Dataset name.
     */
    #[Required]
    public string $name;

    /**
     * URL-friendly slug.
     */
    #[Required]
    public string $slug;

    /**
     * Last update timestamp.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Attribution text.
     */
    #[Optional(nullable: true)]
    public ?string $attribution;

    /**
     * Dataset description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * License identifier.
     */
    #[Optional(nullable: true)]
    public ?string $license;

    /**
     * Source data URL.
     */
    #[Optional('source_url', nullable: true)]
    public ?string $sourceURL;

    /**
     * `new Dataset()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Dataset::with(id: ..., insertedAt: ..., name: ..., slug: ..., updatedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Dataset)
     *   ->withID(...)
     *   ->withInsertedAt(...)
     *   ->withName(...)
     *   ->withSlug(...)
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
     */
    public static function with(
        string $id,
        \DateTimeInterface $insertedAt,
        string $name,
        string $slug,
        \DateTimeInterface $updatedAt,
        ?string $attribution = null,
        ?string $description = null,
        ?string $license = null,
        ?string $sourceURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['insertedAt'] = $insertedAt;
        $self['name'] = $name;
        $self['slug'] = $slug;
        $self['updatedAt'] = $updatedAt;

        null !== $attribution && $self['attribution'] = $attribution;
        null !== $description && $self['description'] = $description;
        null !== $license && $self['license'] = $license;
        null !== $sourceURL && $self['sourceURL'] = $sourceURL;

        return $self;
    }

    /**
     * Dataset ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Creation timestamp.
     */
    public function withInsertedAt(\DateTimeInterface $insertedAt): self
    {
        $self = clone $this;
        $self['insertedAt'] = $insertedAt;

        return $self;
    }

    /**
     * Dataset name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * URL-friendly slug.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Attribution text.
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
     * License identifier.
     */
    public function withLicense(?string $license): self
    {
        $self = clone $this;
        $self['license'] = $license;

        return $self;
    }

    /**
     * Source data URL.
     */
    public function withSourceURL(?string $sourceURL): self
    {
        $self = clone $this;
        $self['sourceURL'] = $sourceURL;

        return $self;
    }
}
