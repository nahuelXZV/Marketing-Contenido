<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Services\DreamIAService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Storage;
use Mockery;

class DreamIAServiceTest extends TestCase
{
    public $client;
    public $apiKey;
    public DreamIAService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Mockery::mock(Client::class);
        $this->apiKey = 'dummy-api-key';
        $this->service = new DreamIAService();
        $this->service->client = $this->client;
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateTask()
    {
        $options = ['some_option' => 'value'];

        // Define la respuesta esperada del cliente HTTP
        $responseBody = json_encode(['id' => 'dummy-task-id']);
        $this->client->shouldReceive('post')
            ->once()
            ->andReturn(new Response(200, [], $responseBody));

        $result = $this->service->createTask($options);

        $this->assertEquals(['id' => 'dummy-task-id'], $result);
    }

    public function testGetImage()
    {
        $task = 'dummy-task-id';
        $responseBodyInProgress = json_encode(['state' => 'in_progress']);
        $responseBodyCompleted = json_encode(['state' => 'completed', 'result' => 'https://example.com/image.jpg']);

        // Define las respuestas esperadas del cliente HTTP
        $this->client->shouldReceive('get')
            ->times(2)
            ->andReturn(
                new Response(200, [], $responseBodyInProgress),
                new Response(200, [], $responseBodyCompleted)
            );

        $result = $this->service->getImage($task);

        $this->assertEquals('https://example.com/image.jpg', $result);
    }
}
