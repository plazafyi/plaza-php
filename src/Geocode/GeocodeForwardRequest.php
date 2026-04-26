<?php

declare(strict_types=1);

namespace Plaza\Geocode;

use Plaza\Core\Attributes\Optional;
use Plaza\Core\Attributes\Required;
use Plaza\Core\Concerns\SdkModel;
use Plaza\Core\Contracts\BaseModel;
use Plaza\PlazaClientService\PointGeometry;

/**
 * Request body for forward geocoding. Converts an address or place name to coordinates.
 *
 * @phpstan-import-type PointGeometryShape from \Plaza\PlazaClientService\PointGeometry
 *
 * @phpstan-type GeocodeForwardRequestShape = array{
 *   q: string,
 *   countryCode?: string|null,
 *   focus?: null|PointGeometry|PointGeometryShape,
 *   lang?: string|null,
 *   layer?: string|null,
 *   limit?: int|null,
 * }
 */
final class GeocodeForwardRequest implements BaseModel
{
    /** @use SdkModel<GeocodeForwardRequestShape> */
    use SdkModel;

    /**
     * Address or place name to geocode.
     */
    #[Required]
    public string $q;

    /**
     * ISO 3166-1 alpha-2 country code to restrict results.
     */
    #[Optional('country_code', nullable: true)]
    public ?string $countryCode;

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     */
    #[Optional(nullable: true)]
    public ?PointGeometry $focus;

    /**
     * Preferred response language (ISO 639-1).
     */
    #[Optional(nullable: true)]
    public ?string $lang;

    /**
     * Filter by result layer (e.g. `address`, `place`, `poi`).
     */
    #[Optional(nullable: true)]
    public ?string $layer;

    /**
     * Maximum number of results (default: 5, max: 50).
     */
    #[Optional(nullable: true)]
    public ?int $limit;

    /**
     * `new GeocodeForwardRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GeocodeForwardRequest::with(q: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GeocodeForwardRequest)->withQ(...)
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
     * @param PointGeometry|PointGeometryShape|null $focus
     */
    public static function with(
        string $q,
        ?string $countryCode = null,
        PointGeometry|array|null $focus = null,
        ?string $lang = null,
        ?string $layer = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        $self['q'] = $q;

        null !== $countryCode && $self['countryCode'] = $countryCode;
        null !== $focus && $self['focus'] = $focus;
        null !== $lang && $self['lang'] = $lang;
        null !== $layer && $self['layer'] = $layer;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Address or place name to geocode.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code to restrict results.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * GeoJSON Point geometry per RFC 7946. Coordinates use [longitude, latitude] order. Optional third element is altitude in meters.
     *
     * @param PointGeometry|PointGeometryShape|null $focus
     */
    public function withFocus(PointGeometry|array|null $focus): self
    {
        $self = clone $this;
        $self['focus'] = $focus;

        return $self;
    }

    /**
     * Preferred response language (ISO 639-1).
     */
    public function withLang(?string $lang): self
    {
        $self = clone $this;
        $self['lang'] = $lang;

        return $self;
    }

    /**
     * Filter by result layer (e.g. `address`, `place`, `poi`).
     */
    public function withLayer(?string $layer): self
    {
        $self = clone $this;
        $self['layer'] = $layer;

        return $self;
    }

    /**
     * Maximum number of results (default: 5, max: 50).
     */
    public function withLimit(?int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
