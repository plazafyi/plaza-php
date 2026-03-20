<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\PlazaClientService\GeoJsonFeature;

/**
 * @internal
 */
#[CoversNothing]
final class ElementsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->elements->retrieve(0, type: 'type');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeoJsonFeature::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->elements->retrieve(0, type: 'type');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeoJsonFeature::class, $result);
    }

    #[Test]
    public function testBatch(): void
    {
        $result = $this->client->elements->batch(
            elements: [
                ['id' => 21154906, 'type' => 'node'], ['id' => 4589123, 'type' => 'way'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testBatchWithOptionalParams(): void
    {
        $result = $this->client->elements->batch(
            elements: [
                ['id' => 21154906, 'type' => 'node'], ['id' => 4589123, 'type' => 'way'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testLookup(): void
    {
        $result = $this->client->elements->lookup();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeoJsonFeature::class, $result);
    }

    #[Test]
    public function testNearby(): void
    {
        $result = $this->client->elements->nearby();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testNearbyPost(): void
    {
        $result = $this->client->elements->nearbyPost();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testQuery(): void
    {
        $result = $this->client->elements->query();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testQueryPost(): void
    {
        $result = $this->client->elements->queryPost();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }
}
