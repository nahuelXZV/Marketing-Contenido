<?php

namespace App\Services\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class DreamIAService
{
    protected $client;
    protected $apiKey;
    protected $headers;

    public function __construct()
    {
        $this->apiKey = config('services.dream.key');
        $this->client = new Client([
            'base_uri' => 'https://api.luan.tools/api/tasks/',
        ]);
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];
    }

    public function generateImage($options)
    {
        $task = $this->createTask($options);
        $task_id = $task['id'];
        $this->sendPrompt($task_id, $options);
        $final_url = $this->getImage($task_id);
        $url_s3 = $this->saveImageS3($final_url);
        $dataResponse = [
            'url' => $url_s3,
            'task_id' => $task_id,
            'options' => $options,
        ];
        return $dataResponse;
    }

    private function createTask($options)
    {
        $response = $this->client->post('', [
            'headers' => $this->headers,
            'json' => [
                'use_target_image' => false
            ],
        ]);
        return json_decode($response->getBody(), true);
    }

    private function sendPrompt($task, $options)
    {
        $response = $this->client->put($task, [
            'headers' => $this->headers,
            'json' => [
                'input_spec' => $options,
            ],
        ]);
        return json_decode($response->getBody(), true);
    }

    private function getImage($task)
    {
        while (true) {
            $response = $this->client->get($task, [
                'headers' => $this->headers,
            ]);
            $response = json_decode($response->getBody(), true);
            if ($response['state'] == 'failed') {
                return null;
            }
            if ($response['state'] == 'completed') {
                $final_url = $response['result'];
                return $final_url;
            }
            sleep(2);
        }
    }

    private function saveImageS3($url)
    {
        $client = new Client();
        $response = $client->get($url);
        $nameImage = 'marketing/publications/' . Date('YmdHi') . '.jpg';
        Storage::disk('s3')->put($nameImage, $response->getBody(), 'public');
        $url = Storage::disk('s3')->url($nameImage);
        return $url;
    }
}
