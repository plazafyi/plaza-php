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
        $result = $this->client->geocode->autocomplete(q: '221B Bak');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AutocompleteResult::class, $result);
    }

    #[Test]
    public function testAutocompleteWithOptionalParams(): void
    {
        $result = $this->client->geocode->autocomplete(
            q: '221B Bak',
            format: 'format',
            countryCode: 'xx',
            focus: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            lang: 'lang',
            layer: 'layer',
            limit: 1,
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
        $result = $this->client->geocode->forward(q: '221B Baker Street, London');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeResult::class, $result);
    }

    #[Test]
    public function testForwardWithOptionalParams(): void
    {
        $result = $this->client->geocode->forward(
            q: '221B Baker Street, London',
            format: 'format',
            countryCode: 'xx',
            focus: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            lang: 'lang',
            layer: 'layer',
            limit: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeocodeResult::class, $result);
    }

    #[Test]
    public function testReverse(): void
    {
        $result = $this->client->geocode->reverse(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReverseGeocodeResult::class, $result);
    }

    #[Test]
    public function testReverseWithOptionalParams(): void
    {
        $result = $this->client->geocode->reverse(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            format: 'format',
            lang: 'lang',
            limit: 1,
            radius: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReverseGeocodeResult::class, $result);
    }
}
