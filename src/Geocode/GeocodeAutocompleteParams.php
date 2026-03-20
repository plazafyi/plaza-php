<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Concerns\SdkParams;
use Plaza\Core\Contracts\BaseModel;

/**
 * Autocomplete a partial address.
 *
 * @see Plaza\Services\GeocodeService::autocomplete()
 *
 * @phpstan-type GeocodeAutocompleteParamsShape = array{
 *   q: string,
 *   countryCode?: string|null,
 *   format?: string|null,
 *   lang?: string|null,
 *   lat?: float|null,
 *   layer?: string|null,
 *   limit?: int|null,
 *   lng?: float|null,
 * }
 */
final class GeocodeAutocompleteParams implements BaseModel
{
    /** @use SdkModel<GeocodeAutocompleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Partial address query.
     */
    #[Required]
    public string $q;

    /**
     * ISO 3166-1 alpha-2 country code filter.
     */
    #[Optional]
    public ?string $countryCode;

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    #[Optional]
    public ?string $format;

    /**
     * Language code for localized names (e.g. en, de, fr).
     */
    #[Optional]
    public ?string $lang;

    /**
     * Focus latitude.
     */
    #[Optional]
    public ?float $lat;

    /**
     * Filter by layer: address, poi, or admin.
     */
    #[Optional]
    public ?string $layer;

    /**
     * Maximum results (default 10, max 20).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Focus longitude.
     */
    #[Optional]
    public ?float $lng;

    /**
     * `new GeocodeAutocompleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeAutocompleteParams::with(q: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeAutocompleteParams)->withQ(...)
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
        string $q,
        ?string $countryCode = null,
        ?string $format = null,
        ?string $lang = null,
        ?float $lat = null,
        ?string $layer = null,
        ?int $limit = null,
        ?float $lng = null,
    ): self {
        $self = new self;

        $self['q'] = $q;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $format && $self['format'] = $format;
        null !== $lang && $self['lang'] = $lang;
        null !== $lat && $self['lat'] = $lat;
        null !== $layer && $self['layer'] = $layer;
        null !== $limit && $self['limit'] = $limit;
        null !== $lng && $self['lng'] = $lng;

        return $self;
    }

    /**
     * Partial address query.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code filter.
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Response format: json (default), geojson, csv, ndjson.
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Language code for localized names (e.g. en, de, fr).
     */
    public function withLang(string $lang): self
    {
        $self = clone $this;
        $self['lang'] = $lang;

        return $self;
    }

    /**
     * Focus latitude.
     */
    public function withLat(float $lat): self
    {
        $self = clone $this;
        $self['lat'] = $lat;

        return $self;
    }

    /**
     * Filter by layer: address, poi, or admin.
     */
    public function withLayer(string $layer): self
    {
        $self = clone $this;
        $self['layer'] = $layer;

        return $self;
    }

    /**
     * Maximum results (default 10, max 20).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Focus longitude.
     */
    public function withLng(float $lng): self
    {
        $self = clone $this;
        $self['lng'] = $lng;

        return $self;
    }
}
