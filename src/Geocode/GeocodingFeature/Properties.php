<?php

declare(strict_types=1);

namespace Plaza\Geocode\GeocodingFeature;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\Geocode\GeocodingFeature\Properties\OsmType;
use Plaza\Geocode\GeocodingFeature\Properties\Source;

/**
 * Geocoding result properties.
 *
 * @phpstan-type PropertiesShape = array{
 *   displayName: string,
 *   category?: string|null,
 *   city?: string|null,
 *   confidence?: float|null,
 *   country?: string|null,
 *   countryCode?: string|null,
 *   distanceM?: float|null,
 *   fullAddress?: string|null,
 *   houseNumber?: string|null,
 *   interpolated?: bool|null,
 *   name?: string|null,
 *   osmID?: int|null,
 *   osmType?: null|OsmType|value-of<OsmType>,
 *   postcode?: string|null,
 *   score?: float|null,
 *   source?: null|Source|value-of<Source>,
 *   state?: string|null,
 *   street?: string|null,
 *   subcategory?: string|null,
 *   tags?: array<string,string>|null,
 *   wikipedia?: string|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * Formatted address or place name.
     */
    #[Required('display_name')]
    public string $displayName;

    /**
     * POI category (e.g. restaurant, cafe, park). Present for place results.
     */
    #[Optional(nullable: true)]
    public ?string $category;

    /**
     * City or town name. Present for address results.
     */
    #[Optional(nullable: true)]
    public ?string $city;

    /**
     * Interpolation confidence (0-1). Present only for interpolated results.
     */
    #[Optional(nullable: true)]
    public ?float $confidence;

    /**
     * Country name. Present for reverse geocode address results.
     */
    #[Optional(nullable: true)]
    public ?string $country;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Optional('country_code', nullable: true)]
    public ?string $countryCode;

    /**
     * Distance from the query point in meters (reverse geocode / nearby only).
     */
    #[Optional('distance_m', nullable: true)]
    public ?float $distanceM;

    /**
     * Complete formatted address from the database. Present for reverse geocode address results.
     */
    #[Optional('full_address', nullable: true)]
    public ?string $fullAddress;

    /**
     * House or building number. Present for address and interpolated results.
     */
    #[Optional('house_number', nullable: true)]
    public ?string $houseNumber;

    /**
     * Whether this result was estimated by address interpolation rather than an exact database match.
     */
    #[Optional(nullable: true)]
    public ?bool $interpolated;

    /**
     * Place name (raw). Present for reverse geocode place results.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * OpenStreetMap element ID (null for interpolated results).
     */
    #[Optional('osm_id', nullable: true)]
    public ?int $osmID;

    /**
     * OSM element type (node, way, relation).
     *
     * @var value-of<OsmType>|null $osmType
     */
    #[Optional('osm_type', enum: OsmType::class, nullable: true)]
    public ?string $osmType;

    /**
     * Postal code. Present for reverse geocode address results.
     */
    #[Optional(nullable: true)]
    public ?string $postcode;

    /**
     * Relevance score (higher is better). Incorporates text match quality, spatial proximity boost, and popularity signals. Not bounded to 0-1.
     */
    #[Optional(nullable: true)]
    public ?float $score;

    /**
     * Result source indicating how the result was found: structured (exact field match), fuzzy (trigram similarity), address (reverse geocode address), place (reverse geocode POI), interpolation (estimated from neighboring addresses).
     *
     * @var value-of<Source>|null $source
     */
    #[Optional(enum: Source::class, nullable: true)]
    public ?string $source;

    /**
     * State or province name. Present for reverse geocode address results.
     */
    #[Optional(nullable: true)]
    public ?string $state;

    /**
     * Street name. Present for address and interpolated results.
     */
    #[Optional(nullable: true)]
    public ?string $street;

    /**
     * POI subcategory. Present for place results.
     */
    #[Optional(nullable: true)]
    public ?string $subcategory;

    /**
     * Raw OSM tags. Present for place results.
     *
     * @var array<string,string>|null $tags
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $tags;

    /**
     * Wikipedia article reference (e.g. en:Eiffel Tower). Present for notable places.
     */
    #[Optional(nullable: true)]
    public ?string $wikipedia;

    /**
     * `new Properties()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Properties::with(displayName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Properties)->withDisplayName(...)
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
     * @param OsmType|value-of<OsmType>|null $osmType
     * @param Source|value-of<Source>|null $source
     * @param array<string,string>|null $tags
     */
    public static function with(
        string $displayName,
        ?string $category = null,
        ?string $city = null,
        ?float $confidence = null,
        ?string $country = null,
        ?string $countryCode = null,
        ?float $distanceM = null,
        ?string $fullAddress = null,
        ?string $houseNumber = null,
        ?bool $interpolated = null,
        ?string $name = null,
        ?int $osmID = null,
        OsmType|string|null $osmType = null,
        ?string $postcode = null,
        ?float $score = null,
        Source|string|null $source = null,
        ?string $state = null,
        ?string $street = null,
        ?string $subcategory = null,
        ?array $tags = null,
        ?string $wikipedia = null,
    ): self {
        $self = new self;

        $self['displayName'] = $displayName;

        null !== $category && $self['category'] = $category;
        null !== $city && $self['city'] = $city;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $country && $self['country'] = $country;
        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $distanceM && $self['distanceM'] = $distanceM;
        null !== $fullAddress && $self['fullAddress'] = $fullAddress;
        null !== $houseNumber && $self['houseNumber'] = $houseNumber;
        null !== $interpolated && $self['interpolated'] = $interpolated;
        null !== $name && $self['name'] = $name;
        null !== $osmID && $self['osmID'] = $osmID;
        null !== $osmType && $self['osmType'] = $osmType;
        null !== $postcode && $self['postcode'] = $postcode;
        null !== $score && $self['score'] = $score;
        null !== $source && $self['source'] = $source;
        null !== $state && $self['state'] = $state;
        null !== $street && $self['street'] = $street;
        null !== $subcategory && $self['subcategory'] = $subcategory;
        null !== $tags && $self['tags'] = $tags;
        null !== $wikipedia && $self['wikipedia'] = $wikipedia;

        return $self;
    }

    /**
     * Formatted address or place name.
     */
    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * POI category (e.g. restaurant, cafe, park). Present for place results.
     */
    public function withCategory(?string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * City or town name. Present for address results.
     */
    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * Interpolation confidence (0-1). Present only for interpolated results.
     */
    public function withConfidence(?float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Country name. Present for reverse geocode address results.
     */
    public function withCountry(?string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Distance from the query point in meters (reverse geocode / nearby only).
     */
    public function withDistanceM(?float $distanceM): self
    {
        $self = clone $this;
        $self['distanceM'] = $distanceM;

        return $self;
    }

    /**
     * Complete formatted address from the database. Present for reverse geocode address results.
     */
    public function withFullAddress(?string $fullAddress): self
    {
        $self = clone $this;
        $self['fullAddress'] = $fullAddress;

        return $self;
    }

    /**
     * House or building number. Present for address and interpolated results.
     */
    public function withHouseNumber(?string $houseNumber): self
    {
        $self = clone $this;
        $self['houseNumber'] = $houseNumber;

        return $self;
    }

    /**
     * Whether this result was estimated by address interpolation rather than an exact database match.
     */
    public function withInterpolated(?bool $interpolated): self
    {
        $self = clone $this;
        $self['interpolated'] = $interpolated;

        return $self;
    }

    /**
     * Place name (raw). Present for reverse geocode place results.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * OpenStreetMap element ID (null for interpolated results).
     */
    public function withOsmID(?int $osmID): self
    {
        $self = clone $this;
        $self['osmID'] = $osmID;

        return $self;
    }

    /**
     * OSM element type (node, way, relation).
     *
     * @param OsmType|value-of<OsmType>|null $osmType
     */
    public function withOsmType(OsmType|string|null $osmType): self
    {
        $self = clone $this;
        $self['osmType'] = $osmType;

        return $self;
    }

    /**
     * Postal code. Present for reverse geocode address results.
     */
    public function withPostcode(?string $postcode): self
    {
        $self = clone $this;
        $self['postcode'] = $postcode;

        return $self;
    }

    /**
     * Relevance score (higher is better). Incorporates text match quality, spatial proximity boost, and popularity signals. Not bounded to 0-1.
     */
    public function withScore(?float $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Result source indicating how the result was found: structured (exact field match), fuzzy (trigram similarity), address (reverse geocode address), place (reverse geocode POI), interpolation (estimated from neighboring addresses).
     *
     * @param Source|value-of<Source>|null $source
     */
    public function withSource(Source|string|null $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * State or province name. Present for reverse geocode address results.
     */
    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * Street name. Present for address and interpolated results.
     */
    public function withStreet(?string $street): self
    {
        $self = clone $this;
        $self['street'] = $street;

        return $self;
    }

    /**
     * POI subcategory. Present for place results.
     */
    public function withSubcategory(?string $subcategory): self
    {
        $self = clone $this;
        $self['subcategory'] = $subcategory;

        return $self;
    }

    /**
     * Raw OSM tags. Present for place results.
     *
     * @param array<string,string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Wikipedia article reference (e.g. en:Eiffel Tower). Present for notable places.
     */
    public function withWikipedia(?string $wikipedia): self
    {
        $self = clone $this;
        $self['wikipedia'] = $wikipedia;

        return $self;
    }
}
