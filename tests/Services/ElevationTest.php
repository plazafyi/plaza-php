<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
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
    public function testLookup(): void
    {
        $result = $this->client->elevation->lookup(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationLookupResult::class, $result);
    }

    #[Test]
    public function testLookupWithOptionalParams(): void
    {
        $result = $this->client->elevation->lookup(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            format: 'format',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationLookupResult::class, $result);
    }

    #[Test]
    public function testProfile(): void
    {
        $result = $this->client->elevation->profile(
            geometry: [
                'coordinates' => [[2.3522, 48.8566], [2.34, 48.858], [2.2945, 48.8584]],
                'type' => 'LineString',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationProfileResult::class, $result);
    }

    #[Test]
    public function testProfileWithOptionalParams(): void
    {
        $result = $this->client->elevation->profile(
            geometry: [
                'coordinates' => [[2.3522, 48.8566], [2.34, 48.858], [2.2945, 48.8584]],
                'type' => 'LineString',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ElevationProfileResult::class, $result);
    }
}
