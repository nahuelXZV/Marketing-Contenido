<?php

namespace App\Services\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class OpenIAService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/chat/completions',
        ]);
    }

    public function sendMenssage($message)
    {
        $response = $this->client->post('completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo', // El modelo que desees usar
                // 'response_format' => ["type" => "json_object"],
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un generador de publicaciones de redes sociales. La empresa para la que trabajas es una orquetas de música clásica. Tienes que respondes con un json con la siguiente estructura: ["publicacion" => "texto de la publicación", "titulo" => "titulo de la publicación" ,"propuesta_imagen" => "propuesta para generar la imagen mediante IA relacionada con la publicacion y ser de maximo 350 letras y minimo 50, describir que debe tener la imagen, solo imagen no texto ni otras cosas"].',
                    ],
                    [
                        'role' => 'user',
                        'content' => $message,
                    ],
                ],
                'temperature' => 0.8, // Controla la creatividad de la respuesta
            ],
        ]);
        $responseOpenIA = json_decode($response->getBody(), true);
        if ($responseOpenIA && is_array($responseOpenIA['choices'])) {
            $responseString = $responseOpenIA['choices'][0]['message']['content'];
            return json_decode($responseString, true);
        } else {
            throw new \Exception("Error al generar las publicaciones");
        }
    }

    public function translate($text)
    {
        $response = $this->client->post('completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo', // El modelo que desees usar
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un traductor de texto. La empresa para la que trabajas es una orquetas de música clásica. Tienes que responder con el texto traducido.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $text,
                    ],
                ],
                'temperature' => 0.8, // Controla la creatividad de la respuesta
            ],
        ]);
        $responseOpenIA = json_decode($response->getBody(), true);
        if ($responseOpenIA && is_array($responseOpenIA['choices'])) {
            $responseString = $responseOpenIA['choices'][0]['message']['content'];
            $responseString = preg_replace('/\\\\u([0-9a-fA-F]{4})/', '&#x$1;', $responseString);
            return $responseString;
        } else {
            throw new \Exception("Error al generar las publicaciones");
        }
    }


    // generateImage {w,h,prompt,size,quality}
    public function generateImage($options)
    {
        $client = new Client([
            'base_uri' => 'https://api.openai.com/v1/images/generations',
        ]);
        $response = $client->post('generations', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'dall-e-3', // El modelo que desees usar
                'prompt' => $options['prompt'],
                'size' => '1024x1024',
                'quality' => 'standard',
                'n' => 1
            ],
        ]);
        $responseOpenIA = json_decode($response->getBody(), true);
        if ($responseOpenIA && is_array($responseOpenIA)) {
            $final_url = $responseOpenIA['data'][0]['url'];
            $url_s3 = $this->saveImageS3($final_url);
            $dataResponse = [
                'url' => $url_s3,
                'task_id' => 'dall-e-3',
            ];
            return $dataResponse;
        } else {
            throw new \Exception("Error al generar la imagen");
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
