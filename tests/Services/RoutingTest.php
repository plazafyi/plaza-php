<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\PlazaClientService\GeoJsonFeature;
use Plaza\Routing\MatrixResult;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;

/**
 * @internal
 */
#[CoversNothing]
final class RoutingTest extends TestCase
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
    public function testIsochrone(): void
    {
        $result = $this->client->routing->isochrone(lat: 0, lng: 0, time: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeoJsonFeature::class, $result);
    }

    #[Test]
    public function testIsochroneWithOptionalParams(): void
    {
        $result = $this->client->routing->isochrone(
            lat: 0,
            lng: 0,
            time: 0,
            mode: 'mode'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(GeoJsonFeature::class, $result);
    }

    #[Test]
    public function testMatrix(): void
    {
        $result = $this->client->routing->matrix(
            destinations: ['coordinates' => [0], 'type' => 'Point'],
            origins: ['coordinates' => [0], 'type' => 'Point'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MatrixResult::class, $result);
    }

    #[Test]
    public function testMatrixWithOptionalParams(): void
    {
        $result = $this->client->routing->matrix(
            destinations: ['coordinates' => [0], 'type' => 'Point'],
            origins: ['coordinates' => [0], 'type' => 'Point'],
            mode: 'auto',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MatrixResult::class, $result);
    }

    #[Test]
    public function testNearest(): void
    {
        $result = $this->client->routing->nearest(lat: 0, lng: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testNearestWithOptionalParams(): void
    {
        $result = $this->client->routing->nearest(lat: 0, lng: 0, radius: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testRoute(): void
    {
        $result = $this->client->routing->route(
            destination: ['coordinates' => [0], 'type' => 'Point'],
            origin: ['coordinates' => [0], 'type' => 'Point'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RouteResult::class, $result);
    }

    #[Test]
    public function testRouteWithOptionalParams(): void
    {
        $result = $this->client->routing->route(
            destination: ['coordinates' => [0], 'type' => 'Point'],
            origin: ['coordinates' => [0], 'type' => 'Point'],
            mode: 'auto',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RouteResult::class, $result);
    }
}
