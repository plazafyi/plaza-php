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
final class SearchTest extends TestCase
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
    public function testQuery(): void
    {
        $result = $this->client->search->query(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testQueryWithOptionalParams(): void
    {
        $result = $this->client->search->query(
            q: 'q',
            cursor: 'cursor',
            format: 'format',
            limit: 0,
            outputFields: 'output[fields]',
            outputInclude: 'output[include]',
            outputPrecision: 0,
            outputSort: 'output[sort]',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testQueryPost(): void
    {
        $result = $this->client->search->queryPost(q: 'q');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testQueryPostWithOptionalParams(): void
    {
        $result = $this->client->search->queryPost(
            q: 'q',
            cursor: 'cursor',
            format: 'format',
            limit: 0,
            outputFields: 'output[fields]',
            outputInclude: 'output[include]',
            outputPrecision: 0,
            outputSort: 'output[sort]',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }
}
