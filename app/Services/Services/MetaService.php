<?php

namespace App\Services\Services;

use App\Services\System\CompanyService;
use Exception;
use GuzzleHttp\Client;

class MetaService
{
    protected $client;
    protected $token;
    protected $headers;
    protected $pageId;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://graph.facebook.com/v20.0/act_357983907302107/',
        ]);
        $companyService = new CompanyService();
        $this->token =  $companyService->getOne(1)->meta_access_token ?? '';
        $this->pageId = $companyService->getOne(1)->meta_page_id_meta ?? '';
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json'
        ];
    }

    public function createCampaign($publicationConfiguration)
    {
        try {
            $response = $this->client->post('campaigns', [
                'headers' => $this->headers,
                'json' => [
                    'name' => $publicationConfiguration["name"],
                    'status' => $publicationConfiguration["status"],
                    'objective' => $publicationConfiguration["objective"],
                    'special_ad_categories' => [],
                ],
            ]);
            $response = json_decode($response->getBody(), true);
            return $response['id'];
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }


    public function createAdSet($publicationConfiguration)
    {
        try {
            $response = $this->client->post('adsets', [
                'headers' => $this->headers,
                'json' => [
                    'name' => $publicationConfiguration["name"],
                    'optimization_goal' => $publicationConfiguration["optimization_goal"],
                    'billing_event' => $publicationConfiguration["billing_event"],
                    'bid_amount' => $publicationConfiguration["bid_amount"],
                    'daily_budget' => $publicationConfiguration["daily_budget"],
                    'campaign_id' => $publicationConfiguration["campaign_id"],
                    // 'targeting' => `{\"geo_locations\": {\"countries\":[\"BO\"]}`,
                    'targeting' => [
                        'geo_locations' => [
                            'countries' => ['BO']
                        ]
                    ],
                    'start_time' => $publicationConfiguration["start_time"] . ":00+0000",
                    'status' => $publicationConfiguration["status"],
                ],
            ]);
            $response = json_decode($response->getBody(), true);
            return $response['id'];
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }

    public function createAdimages($resource)
    {
        try {
            // Obtener el contenido de la imagen desde la URL
            $imageResponse = $this->client->get($resource->url_imagen);
            if ($imageResponse->getStatusCode() !== 200) {
                throw new Exception('Failed to fetch image from URL.');
            }

            // Obtener el contenido de la imagen y el tipo de contenido
            $imageContents = $imageResponse->getBody()->getContents();
            $contentType = $imageResponse->getHeaderLine('Content-Type');

            // Crear un recurso de stream en memoria para el contenido de la imagen
            $stream = fopen('php://temp', 'r+');
            fwrite($stream, $imageContents);
            rewind($stream);

            $headers = [
                'Authorization' => 'Bearer ' . $this->token,
            ];
            // Configurar las opciones del multipart
            $options = [
                'multipart' => [
                    [
                        'name' => 'filename',
                        'contents' => $stream,
                        'filename' => basename($resource->url_imagen),
                        'headers'  => [
                            'Content-Type' => $contentType
                        ]
                    ]
                ]
            ];

            // Crear y enviar la petición
            $response = $this->client->post('adimages', [
                'headers' => $headers,
                'multipart' => $options['multipart']
            ]);

            // Decodificar la respuesta
            $response = json_decode($response->getBody(), true);
            return [
                'hash' => $response['images'][basename($resource->url_imagen)]['hash'],
                'url' => $response['images'][basename($resource->url_imagen)]['url'],
            ];
        } catch (\Throwable $th) {
            // Manejar la excepción
            dd($th->getMessage());
            return false;
        } finally {
            if (isset($stream) && is_resource($stream)) {
                fclose($stream);
            }
        }
    }


    public function createCreative($creativeConfiguration)
    {
        try {
            $response = $this->client->post('adcreatives', [
                'headers' => $this->headers,
                'json' => [
                    'name' => $creativeConfiguration["name"],
                    'object_story_spec' => [
                        'page_id' => $this->pageId,
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
            ]);
            $response = json_decode($response->getBody(), true);
            return $response['id'];
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }


    public function preview($creativeId, $format)
    {
        try {
            $headers = [
                'Authorization' => 'Bearer ' . $this->token,
            ];
            $API = "https://graph.facebook.com/v20.0/" . $creativeId . "/previews?ad_format=" . $format;
            $response = $this->client->get($API, [
                'headers' => $headers,
            ]);
            $response = json_decode($response->getBody(), true);
            return $response['data'][0]['body'];
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
