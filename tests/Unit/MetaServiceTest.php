<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Services\MetaService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;
use App\Services\System\CompanyService;

class MetaServiceTest extends TestCase
{
    public $client;
    public $companyService;
    public MetaService $service;


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Mockery::mock(Client::class);
        $this->companyService = Mockery::mock(CompanyService::class);

        // Mocking the CompanyService to return a dummy token and pageId
        $this->companyService->shouldReceive('getOne')
            ->andReturn((object)['meta_access_token' => 'dummy-token', 'meta_page_id_meta' => 'dummy-page-id']);

        $this->service = new MetaService();
        $this->service->client = $this->client;
        $this->service->token = 'dummy-token';
        $this->service->pageId = 'dummy-page-id';
        $this->service->headers = [
            'Authorization' => 'Bearer dummy-token',
            'Content-Type' => 'application/json',
        ];
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateCampaign()
    {
        $publicationConfiguration = [
            "name" => "Test Campaign",
            "status" => "PAUSED",
            "objective" => "LINK_CLICKS"
        ];

        $responseBody = json_encode(['id' => 'dummy-campaign-id']);
        $this->client->shouldReceive('post')
            ->once()
            ->with('campaigns', [
                'headers' => $this->service->headers,
                'json' => [
                    'name' => $publicationConfiguration["name"],
                    'status' => $publicationConfiguration["status"],
                    'objective' => $publicationConfiguration["objective"],
                    'special_ad_categories' => [],
                ],
            ])
            ->andReturn(new Response(200, [], $responseBody));

        $result = $this->service->createCampaign($publicationConfiguration);

        $this->assertEquals('dummy-campaign-id', $result);
    }

    public function testCreateAdSet()
    {
        $publicationConfiguration = [
            "name" => "Test AdSet",
            "optimization_goal" => "REACH",
            "billing_event" => "IMPRESSIONS",
            "bid_amount" => 100,
            "daily_budget" => 500,
            "campaign_id" => "dummy-campaign-id",
            "start_time" => "2024-06-01T00:00:00",
            "status" => "PAUSED",
        ];

        $responseBody = json_encode(['id' => 'dummy-adset-id']);
        $this->client->shouldReceive('post')
            ->once()
            ->with('adsets', [
                'headers' => $this->service->headers,
                'json' => [
                    'name' => $publicationConfiguration["name"],
                    'optimization_goal' => $publicationConfiguration["optimization_goal"],
                    'billing_event' => $publicationConfiguration["billing_event"],
                    'bid_amount' => $publicationConfiguration["bid_amount"],
                    'daily_budget' => $publicationConfiguration["daily_budget"],
                    'campaign_id' => $publicationConfiguration["campaign_id"],
                    'targeting' => [
                        'geo_locations' => [
                            'countries' => ['BO']
                        ]
                    ],
                    'start_time' => $publicationConfiguration["start_time"] . ":00+0000",
                    'status' => $publicationConfiguration["status"],
                ],
            ])
            ->andReturn(new Response(200, [], $responseBody));

        $result = $this->service->createAdSet($publicationConfiguration);

        $this->assertEquals('dummy-adset-id', $result);
    }

    public function testCreateCreative()
    {
        $creativeConfiguration = [
            "name" => "Test Creative",
            "image_hash" => "dummy-hash",
            "link" => "https://example.com",
            "message" => "Test Message",
        ];

        $responseBody = json_encode(['id' => 'dummy-creative-id']);
        $this->client->shouldReceive('post')
            ->once()
            ->with('adcreatives', [
                'headers' => $this->service->headers,
                'json' => [
                    'name' => $creativeConfiguration["name"],
                    'object_story_spec' => [
                        'page_id' => 'dummy-page-id',
                        'link_data' => [
                            'image_hash' => $creativeConfiguration["image_hash"],
                            'link' => $creativeConfiguration["link"],
                            'message' => $creativeConfiguration["message"],
                        ],
                    ],
                    'degrees_of_freedom_spec' => [
                        'creative_features_spec' => [
                            'standard_enhancements' => [
                                'enroll_status' => 'OPT_IN'
                            ]
                        ]
                    ]
                ],
            ])
            ->andReturn(new Response(200, [], $responseBody));

        $result = $this->service->createCreative($creativeConfiguration);

        $this->assertEquals('dummy-creative-id', $result);
    }

    public function testCreateAd()
    {
        $adConfiguration = [
            "name" => "Test Ad",
            "creative_id" => "dummy-creative-id",
            "adset_id" => "dummy-adset-id",
        ];

        $responseBody = json_encode(['id' => 'dummy-ad-id']);
        $this->client->shouldReceive('post')
            ->once()
            ->with('ads', [
                'headers' => $this->service->headers,
                'json' => [
                    'name' => $adConfiguration["name"],
                    'creative' => [
                        'creative_id' => $adConfiguration["creative_id"],
                    ],
                    'adset_id' => $adConfiguration["adset_id"],
                    'status' => 'PAUSED',
                ],
            ])
            ->andReturn(new Response(200, [], $responseBody));

        $result = $this->service->createAd($adConfiguration);

        $this->assertEquals('dummy-ad-id', $result);
    }
}
