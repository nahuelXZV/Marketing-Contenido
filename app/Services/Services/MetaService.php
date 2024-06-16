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

    /*  RESPONSE
    {
        "data": [
            {
            "impressions": "9708",
            "ad_id": "6142546123068",
            "date_start": "2009-03-28",
            "date_stop": "2016-04-01"
            },
            {
            "impressions": "18841",
            "ad_id": "6142546117828",
            "date_start": "2009-03-28",
            "date_stop": "2016-04-01"
            }
        ],
        "paging": {
            "cursors": {
            "before": "MAZDZD",
            "after": "MQZDZD"
            }
        }
    } */
    public function getInsightsByCampaign($campaignId)
    {
        try {
            $headers = ['Authorization' => 'Bearer ' . $this->token];
            $API = "https://graph.facebook.com/v20.0/" . $campaignId . "/insights?fields=impressions,adset_id,ad_name,date_start,date_stop,campaign_name,clicks,ad_id";
            $response = $this->client->get($API, ['headers' => $headers]);
            $response = json_decode($response->getBody(), true);
            if (count($response['data']) > 0) {
                $responseData = $response['data'][0];
                return $responseData;
            }
            return $this->generateDataExample($campaignId);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }


    private function generateDataExample($campaignId)
    {
        try {
            $response = [
                [
                    'impressions' => '19708',
                    'clicks' => '324',
                    'adset_id' => '6142546123068',
                    'ad_name' => 'Anuncio 1',
                    'ad_id' => '6142546123068',
                    'date_start' => '2009-03-28',
                    'date_stop' => '2016-04-01'
                ],
                [
                    'impressions' => '48841',
                    'clicks' => '250',
                    'adset_id' => '6142546117828',
                    'ad_name' => 'Anuncio 2',
                    'ad_id' => '6142546117828',
                    'date_start' => '2009-03-29',
                    'date_stop' => '2016-04-01'
                ],
                [
                    'impressions' => '45151',
                    'clicks' => '180',
                    'adset_id' => '6142546117828',
                    'ad_name' => 'Anuncio 3',
                    'ad_id' => '6142546117828',
                    'date_start' => '2009-03-30',
                    'date_stop' => '2016-04-01'
                ],
                [
                    'impressions' => '52521',
                    'clicks' => '360',
                    'adset_id' => '6142546117828',
                    'ad_name' => 'Anuncio 4',
                    'ad_id' => '6142546117828',
                    'date_start' => '2009-04-01',
                    'date_stop' => '2016-04-01'
                ],
                [
                    'impressions' => '41415',
                    'clicks' => '220',
                    'adset_id' => '6142546117828',
                    'ad_name' => 'Anuncio 5',
                    'ad_id' => '6142546117828',
                    'date_start' => '2009-04-02',
                    'date_stop' => '2016-04-01'
                ],
            ];
            return $response;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
