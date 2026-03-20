<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\Geocode\AutocompleteResult;
use Plaza\Geocode\GeocodeBatchResponse;
use Plaza\Geocode\GeocodeResult;
use Plaza\Geocode\ReverseGeocodeResult;

/**
 * @internal
 */
#[CoversNothing]
final class GeocodeTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testAutocomplete(): void
    {
        $result = $this->client->geocode->autocomplete(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AutocompleteResult::class, $result);
    }

    #[Test]
    public function testAutocompleteWithOptionalParams(): void
    {
        $result = $this->client->geocode->autocomplete(
            q: 'q',
            countryCode: 'country_code',
            lang: 'lang',
            lat: 0,
            layer: 'layer',
            limit: 0,
            lng: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AutocompleteResult::class, $result);
    }

    #[Test]
    public function testAutocompletePost(): void
    {
        $result = $this->client->geocode->autocompletePost(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AutocompleteResult::class, $result);
    }

    #[Test]
    public function testAutocompletePostWithOptionalParams(): void
    {
        $result = $this->client->geocode->autocompletePost(
            q: 'q',
            countryCode: 'country_code',
            lang: 'lang',
            lat: 0,
            layer: 'layer',
            limit: 0,
            lng: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AutocompleteResult::class, $result);
    }

    #[Test]
    public function testBatch(): void
    {
        $result = $this->client->geocode->batch(addresses: ['string']);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeBatchResponse::class, $result);
    }

    #[Test]
    public function testBatchWithOptionalParams(): void
    {
        $result = $this->client->geocode->batch(addresses: ['string']);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeBatchResponse::class, $result);
    }

    #[Test]
    public function testForward(): void
    {
        $result = $this->client->geocode->forward(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeResult::class, $result);
    }

    #[Test]
    public function testForwardWithOptionalParams(): void
    {
        $result = $this->client->geocode->forward(
            q: 'q',
            bbox: 'bbox',
            countryCode: 'country_code',
            lang: 'lang',
            lat: 0,
            layer: 'layer',
            limit: 0,
            lng: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeResult::class, $result);
    }

    #[Test]
    public function testForwardPost(): void
    {
        $result = $this->client->geocode->forwardPost(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeResult::class, $result);
    }

    #[Test]
    public function testForwardPostWithOptionalParams(): void
    {
        $result = $this->client->geocode->forwardPost(
            q: 'q',
            bbox: 'bbox',
            countryCode: 'country_code',
            lang: 'lang',
            lat: 0,
            layer: 'layer',
            limit: 0,
            lng: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeResult::class, $result);
    }

    #[Test]
    public function testReverse(): void
    {
        $result = $this->client->geocode->reverse();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReverseGeocodeResult::class, $result);
    }

    #[Test]
    public function testReversePost(): void
    {
        $result = $this->client->geocode->reversePost();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReverseGeocodeResult::class, $result);
    }
}
