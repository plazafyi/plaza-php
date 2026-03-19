<?php

declare(strict_types=1);

namespace Plaza\Geocode\GeocodingFeature;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;

/**
 * @phpstan-type PropertiesShape = array{
 *   countryCode?: string|null,
 *   displayName?: string|null,
 *   distanceM?: float|null,
 *   osmID?: int|null,
 *   osmType?: string|null,
 *   score?: float|null,
 *   source?: string|null,
 * }
 */
final class Properties implements BaseModel
{
    /** @use SdkModel<PropertiesShape> */
    use SdkModel;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Optional('country_code', nullable: true)]
    public ?string $countryCode;

    /**
     * Formatted address or place name.
     */
    #[Optional('display_name')]
    public ?string $displayName;

    /**
     * Distance in meters.
     */
    #[Optional('distance_m', nullable: true)]
    public ?float $distanceM;

    /**
     * OpenStreetMap ID.
     */
    #[Optional('osm_id', nullable: true)]
    public ?int $osmID;

    /**
     * OSM element type.
     */
    #[Optional('osm_type', nullable: true)]
    public ?string $osmType;

    /**
     * Match confidence score.
     */
    #[Optional(nullable: true)]
    public ?float $score;

    /**
     * Result source (address, place, interpolation).
     */
    #[Optional(nullable: true)]
    public ?string $source;

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
        ?string $countryCode = null,
        ?string $displayName = null,
        ?float $distanceM = null,
        ?int $osmID = null,
        ?string $osmType = null,
        ?float $score = null,
        ?string $source = null,
    ): self {
        $self = new self;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $displayName && $self['displayName'] = $displayName;
        null !== $distanceM && $self['distanceM'] = $distanceM;
        null !== $osmID && $self['osmID'] = $osmID;
        null !== $osmType && $self['osmType'] = $osmType;
        null !== $score && $self['score'] = $score;
        null !== $source && $self['source'] = $source;

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
     * Formatted address or place name.
     */
    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * Distance in meters.
     */
    public function withDistanceM(?float $distanceM): self
    {
        $self = clone $this;
        $self['distanceM'] = $distanceM;

        return $self;
    }

    /**
     * OpenStreetMap ID.
     */
    public function withOsmID(?int $osmID): self
    {
        $self = clone $this;
        $self['osmID'] = $osmID;

        return $self;
    }

    /**
     * OSM element type.
     */
    public function withOsmType(?string $osmType): self
    {
        $self = clone $this;
        $self['osmType'] = $osmType;

        return $self;
    }

    /**
     * Match confidence score.
     */
    public function withScore(?float $score): self
    {
        $self = clone $this;
        $self['score'] = $score;

        return $self;
    }

    /**
     * Result source (address, place, interpolation).
     */
    public function withSource(?string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }
}
