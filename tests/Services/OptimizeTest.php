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
            waypoints: ['coordinates' => [0], 'type' => 'Point']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->optimize->create(
            waypoints: ['coordinates' => [0], 'type' => 'Point'],
            mode: 'auto',
            roundtrip: true,
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
