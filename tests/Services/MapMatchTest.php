<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\MapMatch\MapMatchResult;

/**
 * @internal
 */
#[CoversNothing]
final class MapMatchTest extends TestCase
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
    public function testMatch(): void
    {
        $result = $this->client->mapMatch->match(
            geometry: [
                'coordinates' => [[2.3522, 48.8566], [2.353, 48.857], [2.354, 48.8575]],
                'type' => 'LineString',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MapMatchResult::class, $result);
    }

    #[Test]
    public function testMatchWithOptionalParams(): void
    {
        $result = $this->client->mapMatch->match(
            geometry: [
                'coordinates' => [[2.3522, 48.8566], [2.353, 48.857], [2.354, 48.8575]],
                'type' => 'LineString',
            ],
            radiuses: [0],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MapMatchResult::class, $result);
    }
}
