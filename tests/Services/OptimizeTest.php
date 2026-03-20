<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\Optimize\OptimizeJobStatus;

/**
 * @internal
 */
#[CoversNothing]
final class OptimizeTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->optimize->create(
            waypoints: [
                ['lat' => 48.8566, 'lng' => 2.3522],
                ['lat' => 48.8606, 'lng' => 2.3376],
                ['lat' => 48.8584, 'lng' => 2.2945],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->optimize->create(
            waypoints: [
                ['lat' => 48.8566, 'lng' => 2.3522],
                ['lat' => 48.8606, 'lng' => 2.3376],
                ['lat' => 48.8584, 'lng' => 2.2945],
            ],
            format: 'format',
            mode: 'auto',
            roundtrip: false,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->optimize->retrieve('job_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(OptimizeJobStatus::class, $result);
    }
}
