<?php

namespace Tests\Unit;


use App\Models\Campaign;
use App\Models\Company;
use App\Services\Campaign\CampaignService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class CampaignServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testGetAll()
    {
        Company::factory()->create();
        $campaigns = Campaign::factory()->count(3)->create();

        $result = CampaignService::getAll();

        $this->assertCount(3, $result);
        $this->assertEquals($campaigns->pluck('id')->toArray(), $result->pluck('id')->toArray());
    }


    public function testGetOne()
    {
        $campaign = Campaign::factory()->create();

        $result = CampaignService::getOne($campaign->id);

        $this->assertNotNull($result);
        $this->assertEquals($campaign->id, $result->id);
    }

    public function testCreate()
    {
        Event::fake();

        $campaignData = Campaign::factory()->make()->toArray();

        $result = CampaignService::create($campaignData);

        $this->assertInstanceOf(Campaign::class, $result);
        $this->assertDatabaseHas('campaigns', ['id' => $result->id]);

        Event::assertDispatched(\App\Events\CampaignCreated::class, function ($event) use ($result) {
            return $event->campaign->id === $result->id;
        });
    }
}
