<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochroneResponse;

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
        $result = $this->client->routing->isochrone(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            time: [1],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingIsochroneResponse::class, $result);
    }

    #[Test]
    public function testIsochroneWithOptionalParams(): void
    {
        $result = $this->client->routing->isochrone(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            time: [1],
            format: 'format',
            mode: 'auto',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingIsochroneResponse::class, $result);
    }

    #[Test]
    public function testMatrix(): void
    {
        $result = $this->client->routing->matrix(
            destinations: [['coordinates' => [2.2945, 48.8584], 'type' => 'Point']],
            origins: [
                ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
                ['coordinates' => [2.3376, 48.8606], 'type' => 'Point'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testMatrixWithOptionalParams(): void
    {
        $result = $this->client->routing->matrix(
            destinations: [['coordinates' => [2.2945, 48.8584], 'type' => 'Point']],
            origins: [
                ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
                ['coordinates' => [2.3376, 48.8606], 'type' => 'Point'],
            ],
            annotations: 'annotations',
            fallbackSpeed: 1,
            mode: 'auto',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testNearest(): void
    {
        $result = $this->client->routing->nearest(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testNearestWithOptionalParams(): void
    {
        $result = $this->client->routing->nearest(
            geometry: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            radius: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testRoute(): void
    {
        $result = $this->client->routing->route(
            destination: ['coordinates' => [2.2945, 48.8584], 'type' => 'Point'],
            origin: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RouteResult::class, $result);
    }

    #[Test]
    public function testRouteWithOptionalParams(): void
    {
        $result = $this->client->routing->route(
            destination: ['coordinates' => [2.2945, 48.8584], 'type' => 'Point'],
            origin: ['coordinates' => [2.3522, 48.8566], 'type' => 'Point'],
            format: 'format',
            alternatives: 0,
            annotations: true,
            departAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            ev: [
                'batteryCapacityWh' => 75000,
                'connectorTypes' => ['string'],
                'initialChargePct' => 0,
                'minChargePct' => 0,
                'minPowerKw' => 0,
            ],
            exclude: 'exclude',
            geometries: 'geojson',
            mode: 'auto',
            overview: 'full',
            steps: true,
            trafficModel: 'best_guess',
            waypoints: [['coordinates' => [2.3522, 48.8566], 'type' => 'Point']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RouteResult::class, $result);
    }
}
