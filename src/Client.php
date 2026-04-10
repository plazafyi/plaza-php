<?php

declare(strict_types=1);

namespace Plaza;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Plaza\Core\BaseClient;
use Plaza\Core\Util;
use Plaza\Services\DatasetsService;
use Plaza\Services\ElevationService;
use Plaza\Services\FeaturesService;
use Plaza\Services\GeocodeService;
use Plaza\Services\MapMatchService;
use Plaza\Services\OptimizeService;
use Plaza\Services\QueryService;
use Plaza\Services\RoutingService;
use Plaza\Services\SearchService;
use Plaza\Services\TilesService;

/**
 * @phpstan-import-type NormalizedRequest from \Plaza\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Plaza\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public FeaturesService $features;

    /**
     * @api
     */
    public DatasetsService $datasets;

    /**
     * @api
     */
    public GeocodeService $geocode;

    /**
     * @api
     */
    public SearchService $search;

    /**
     * @api
     */
    public RoutingService $routing;

    /**
     * @api
     */
    public ElevationService $elevation;

    /**
     * @api
     */
    public MapMatchService $mapMatch;

    /**
     * @api
     */
    public OptimizeService $optimize;

    /**
     * @api
     */
    public QueryService $query;

    /**
     * @api
     */
    public TilesService $tiles;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('PLAZA_API_KEY'));

        $baseUrl ??= Util::getenv('PLAZA_BASE_URL') ?: 'https://plaza.fyi';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('plaza/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.0.1',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->features = new FeaturesService($this);
        $this->datasets = new DatasetsService($this);
        $this->geocode = new GeocodeService($this);
        $this->search = new SearchService($this);
        $this->routing = new RoutingService($this);
        $this->elevation = new ElevationService($this);
        $this->mapMatch = new MapMatchService($this);
        $this->optimize = new OptimizeService($this);
        $this->query = new QueryService($this);
        $this->tiles = new TilesService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
