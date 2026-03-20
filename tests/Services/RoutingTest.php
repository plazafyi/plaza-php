<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Plaza\Client;
use Plaza\Core\Util;
use Plaza\Routing\NearestResult;
use Plaza\Routing\RouteResult;
use Plaza\Routing\RoutingIsochronePostResponse;
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
        $result = $this->client->routing->isochrone(lat: 0, lng: 0, time: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingIsochroneResponse::class, $result);
    }

    #[Test]
    public function testIsochroneWithOptionalParams(): void
    {
        $result = $this->client->routing->isochrone(
            lat: 0,
            lng: 0,
            time: 0,
            mode: 'mode',
            outputFields: 'output[fields]',
            outputGeometry: true,
            outputInclude: 'output[include]',
            outputPrecision: 0,
            outputSimplify: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingIsochroneResponse::class, $result);
    }

    #[Test]
    public function testIsochronePost(): void
    {
        $result = $this->client->routing->isochronePost(lat: 0, lng: 0, time: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingIsochronePostResponse::class, $result);
    }

    #[Test]
    public function testIsochronePostWithOptionalParams(): void
    {
        $result = $this->client->routing->isochronePost(
            lat: 0,
            lng: 0,
            time: 0,
            mode: 'mode',
            outputFields: 'output[fields]',
            outputGeometry: true,
            outputInclude: 'output[include]',
            outputPrecision: 0,
            outputSimplify: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingIsochronePostResponse::class, $result);
    }

    #[Test]
    public function testMatrix(): void
    {
        $result = $this->client->routing->matrix(
            destinations: [['lat' => 48.8584, 'lng' => 2.2945]],
            origins: [
                ['lat' => 48.8566, 'lng' => 2.3522], ['lat' => 48.8606, 'lng' => 2.3376],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testMatrixWithOptionalParams(): void
    {
        $result = $this->client->routing->matrix(
            destinations: [['lat' => 48.8584, 'lng' => 2.2945]],
            origins: [
                ['lat' => 48.8566, 'lng' => 2.3522], ['lat' => 48.8606, 'lng' => 2.3376],
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
        $result = $this->client->routing->nearest(lat: 0, lng: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testNearestWithOptionalParams(): void
    {
        $result = $this->client->routing->nearest(
            lat: 0,
            lng: 0,
            outputFields: 'output[fields]',
            outputInclude: 'output[include]',
            outputPrecision: 0,
            radius: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testNearestPost(): void
    {
        $result = $this->client->routing->nearestPost(lat: 0, lng: 0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testNearestPostWithOptionalParams(): void
    {
        $result = $this->client->routing->nearestPost(
            lat: 0,
            lng: 0,
            outputFields: 'output[fields]',
            outputInclude: 'output[include]',
            outputPrecision: 0,
            radius: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(NearestResult::class, $result);
    }

    #[Test]
    public function testRoute(): void
    {
        $result = $this->client->routing->route(
            destination: ['lat' => 48.8584, 'lng' => 2.2945],
            origin: ['lat' => 48.8566, 'lng' => 2.3522],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RouteResult::class, $result);
    }

    #[Test]
    public function testRouteWithOptionalParams(): void
    {
        $result = $this->client->routing->route(
            destination: ['lat' => 48.8584, 'lng' => 2.2945],
            origin: ['lat' => 48.8566, 'lng' => 2.3522],
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
            waypoints: [['lat' => 48.8566, 'lng' => 2.3522]],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RouteResult::class, $result);
    }
}
