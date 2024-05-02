<?php

namespace App\Services\Services;

use GuzzleHttp\Client;

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
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un generador de publicaciones de redes sociales. La empresa para la que trabajas es una orquetas de música clásica. Tienes que respondes con un json con la siguiente estructura: ["publicacion" => "texto de la publicación", "titulo" => "titulo de la publicación" ,"propuesta_imagen" => "propuesta para generar la imagen mediante IA relacionada con la publicacion esta propuesta debe estar en ingles y ser de maximo 350 letras y minimo 50"].',
                    ],
                    [
                        'role' => 'user',
                        'content' => $message,
                    ],
                ],
                'temperature' => 0.9, // Controla la creatividad de la respuesta
            ],
        ]);
        return json_decode($response->getBody(), true);
    }
}
