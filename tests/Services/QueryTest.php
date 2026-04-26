<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;

/**
 * @internal
 */
#[CoversNothing]
final class QueryTest extends TestCase
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
    public function testExecute(): void
    {
        $result = $this->client->query->execute(
            data: '$$ = search(node, amenity: "cafe").around(distance: 500, geometry: point(48.8566, 2.3522));',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testExecuteWithOptionalParams(): void
    {
        $result = $this->client->query->execute(
            data: '$$ = search(node, amenity: "cafe").around(distance: 500, geometry: point(48.8566, 2.3522));',
            format: 'format',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }
}
