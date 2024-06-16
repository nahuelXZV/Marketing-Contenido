<?php

namespace App\Services\Campaign;

use App\Models\PublicationConfiguration;
use App\Services\Services\MetaService;

class PublicationConfigurationService
{

    static public function getOne($id)
    {
        return PublicationConfiguration::find($id);
    }

    static public function getOneByCampaign($campaignId)
    {
        return PublicationConfiguration::where('campaign_id', $campaignId)->first();
    }

    static public function create($publicationConfigurationArray)
    {
        try {
            $metaService = new MetaService();
            $campaignIdMeta = $metaService->createCampaign($publicationConfigurationArray);
            $publicationConfiguration = PublicationConfiguration::create([
                'identificador' => $campaignIdMeta,
                'nombre' => $publicationConfigurationArray['name'],
                'objetivo' => $publicationConfigurationArray['objective'],
                'estado' => $publicationConfigurationArray['status'],
                'campaign_id' => $publicationConfigurationArray['campaign_id'],
            ]);
            $publicationConfiguration->save();
            return $publicationConfiguration;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
