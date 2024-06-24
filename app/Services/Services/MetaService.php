<?php

namespace App\Services\Services;

use App\Services\Campaign\AdSetsService;
use App\Services\System\CompanyService;
use Exception;
use GuzzleHttp\Client;

class MetaService
{
    public $client;
    public $token;
    public $headers;
    public $pageId;

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

    public function createAd($adConfiguration)
    {
        try {
            $response = $this->client->post('ads', [
                'headers' => $this->headers,
                'json' => [
                    'name' => $adConfiguration["name"],
                    'creative' => [
                        'creative_id' => $adConfiguration["creative_id"],
                    ],
                    'adset_id' => $adConfiguration["adset_id"],
                    'status' => 'PAUSED',
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
            // dd($creativeId, $headers);
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


    // insights
    public function getInsights($adSetId)
    {
        try {
            $headers = ['Authorization' => 'Bearer ' . $this->token];
            $API = "https://graph.facebook.com/v20.0/" . $adSetId . "/insights";
            $response = $this->client->get($API, ['headers' => $headers]);
            $response = json_decode($response->getBody(), true);
            return $response['data'][0];
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }

    public function getInsightsByCampaign($campaignId, $campaingIdDb)
    {
        try {
            $headers = ['Authorization' => 'Bearer ' . $this->token];
            // $API = "https://graph.facebook.com/v20.0/" . $campaignId . "/insights?fields=impressions,adset_id,ad_name,date_start,date_stop,campaign_name,clicks,ad_id";
            $API = "https://graph.facebook.com/v20.0/act_357983907302107/campaigns?fields=name,status,adsets{name,insights{impressions,clicks},id}";
            $response = $this->client->get($API, ['headers' => $headers]);
            $response = json_decode($response->getBody(), true);
            $campaign = $this->getCampaignById($campaignId, $response['data']);
            if (array_key_exists('adsets', $campaign) > 0) {
                $insights = $campaign['adsets']['data'];
                $responseData = [];
                foreach ($insights as $item) {
                    if (!array_key_exists('insights', $item)) continue;
                    $responseData[] = [
                        'impressions' => $item['insights']['data'][0]['impressions'] ?? 0,
                        'clicks' => $item['insights']['data'][0]['clicks'] ?? 0,
                        'adset_id' => $item['id'],
                        'ad_name' => $item['name'],
                        'ad_id' => $item['id'],
                        'date_start' => $item['insights']['data'][0]['date_start'],
                        'date_stop' => $item['insights']['data'][0]['date_stop'],
                    ];
                }
                return $responseData;
            }
            return $this->generateDataExample($campaingIdDb);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }

    public function getCampaignById($campaignId, $response)
    {
        foreach ($response as $item) {
            if ($item['id'] == $campaignId) {
                return $item;
            }
        }
    }

    private function generateDataExample($campaignId)
    {
        try {
            $adSets = AdSetsService::getAllByCampaign($campaignId);
            $response = [];
            foreach ($adSets as $key => $adSet) {
                $response[] = [
                    'impressions' => rand(10000, 50000),
                    'clicks' => rand(100, 500),
                    'adset_id' => $adSet->identificador,
                    'ad_name' => $adSet->nombre,
                    'ad_id' => $adSet->id,
                    'date_start' => $adSet->fecha_inicio,
                    'date_stop' => $adSet->fecha_final,
                ];
            }
            return $response;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
