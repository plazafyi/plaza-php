<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\PlazaClientService\FeatureCollection;
use Plaza\Query\QueryExecuteResponse;
use Plaza\Query\SparqlResult;

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
        $result = $this->client->query->execute(steps: [['type' => 'overpass']]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(QueryExecuteResponse::class, $result);
    }

    #[Test]
    public function testExecuteWithOptionalParams(): void
    {
        $result = $this->client->query->execute(
            steps: [['type' => 'overpass', 'query' => 'query']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(QueryExecuteResponse::class, $result);
    }

    #[Test]
    public function testOverpass(): void
    {
        $result = $this->client->query->overpass(
            data: '[out:json];node[amenity=cafe](around:500,48.8566,2.3522);out body;'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testOverpassWithOptionalParams(): void
    {
        $result = $this->client->query->overpass(
            data: '[out:json];node[amenity=cafe](around:500,48.8566,2.3522);out body;'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeatureCollection::class, $result);
    }

    #[Test]
    public function testSparql(): void
    {
        $result = $this->client->query->sparql(
            query: 'SELECT ?s ?name WHERE { ?s osm:name ?name . ?s osm:amenity "cafe" } LIMIT 10',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SparqlResult::class, $result);
    }

    #[Test]
    public function testSparqlWithOptionalParams(): void
    {
        $result = $this->client->query->sparql(
            query: 'SELECT ?s ?name WHERE { ?s osm:name ?name . ?s osm:amenity "cafe" } LIMIT 10',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SparqlResult::class, $result);
    }
}
