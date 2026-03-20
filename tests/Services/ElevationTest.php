<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\Elevation\ElevationBatchResult;
use Plaza\Elevation\ElevationLookupResult;
use Plaza\Elevation\ElevationProfileResult;

/**
 * @internal
 */
#[CoversNothing]
final class ElevationTest extends TestCase
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
    public function testBatch(): void
    {
        $result = $this->client->elevation->batch(
            coordinates: [
                ['lat' => 48.8566, 'lng' => 2.3522], ['lat' => 45.764, 'lng' => 4.8357],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationBatchResult::class, $result);
    }

    #[Test]
    public function testBatchWithOptionalParams(): void
    {
        $result = $this->client->elevation->batch(
            coordinates: [
                ['lat' => 48.8566, 'lng' => 2.3522], ['lat' => 45.764, 'lng' => 4.8357],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationBatchResult::class, $result);
    }

    #[Test]
    public function testLookup(): void
    {
        $result = $this->client->elevation->lookup();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationLookupResult::class, $result);
    }

    #[Test]
    public function testLookupPost(): void
    {
        $result = $this->client->elevation->lookupPost();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationLookupResult::class, $result);
    }

    #[Test]
    public function testProfile(): void
    {
        $result = $this->client->elevation->profile(
            coordinates: [
                ['lat' => 48.8566, 'lng' => 2.3522],
                ['lat' => 48.858, 'lng' => 2.34],
                ['lat' => 48.8584, 'lng' => 2.2945],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationProfileResult::class, $result);
    }

    #[Test]
    public function testProfileWithOptionalParams(): void
    {
        $result = $this->client->elevation->profile(
            coordinates: [
                ['lat' => 48.8566, 'lng' => 2.3522],
                ['lat' => 48.858, 'lng' => 2.34],
                ['lat' => 48.8584, 'lng' => 2.2945],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationProfileResult::class, $result);
    }
}
