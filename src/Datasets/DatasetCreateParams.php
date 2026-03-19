<?php

declare(strict_types=1);

namespace Plaza\Datasets;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Create a new dataset (admin only).
 *
 * @see Plaza\Services\DatasetsService::create()
 *
 * @phpstan-type DatasetCreateParamsShape = array{
 *   name: string,
 *   slug: string,
 *   attribution?: string|null,
 *   description?: string|null,
 *   license?: string|null,
 *   sourceURL?: string|null,
 * }
 */
final class DatasetCreateParams implements BaseModel
{
    /** @use SdkModel<DatasetCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new DatasetCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DatasetCreateParams::with(name: ..., slug: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DatasetCreateParams)->withName(...)->withSlug(...)
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
        string $name,
        string $slug,
        ?string $attribution = null,
        ?string $description = null,
        ?string $license = null,
        ?string $sourceURL = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['slug'] = $slug;

        null !== $attribution && $self['attribution'] = $attribution;
        null !== $description && $self['description'] = $description;
        null !== $license && $self['license'] = $license;
        null !== $sourceURL && $self['sourceURL'] = $sourceURL;

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
