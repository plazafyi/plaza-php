<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\Datasets\Dataset;
use Plaza\Datasets\DatasetList;
use Plaza\PlazaClientService\FeatureCollection;

/**
 * @internal
 */
#[CoversNothing]
final class DatasetsTest extends TestCase
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
        $result = $this->client->datasets->create(name: 'name', slug: 'slug');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Dataset::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->datasets->create(
            name: 'name',
            slug: 'slug',
            attribution: 'attribution',
            description: 'description',
            license: 'license',
            sourceURL: 'source_url',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Dataset::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->datasets->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Dataset::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->datasets->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DatasetList::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->datasets->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testFeatures(): void
    {
        $result = $this->client->datasets->features('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }
}
