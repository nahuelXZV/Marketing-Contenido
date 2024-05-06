<?php

namespace App\Services\Campaign;

use App\Models\Publication;

class PublicationService
{

    static public function getOne($id)
    {
        return Publication::find($id);
    }

    static public function getAllByCampaign($campaignId)
    {
        return Publication::where('campaign_id', $campaignId)->get();
    }

    static public function getAllByCampaignPaginate($campaignId, $search, $paginate)
    {
        return Publication::where('campaign_id', $campaignId)
            ->where('titulo', 'like', '%' . $search . '%')
            ->paginate($paginate);
    }

    static public function getAllByCampaignTimeline($campaignId)
    {
        return Publication::where('campaign_id', $campaignId)
            ->orderBy('fecha_publicacion', 'desc')
            ->orderBy('hora_publicacion', 'desc')
            ->get();
    }

    static public function create($publicationArray)
    {
        try {
            $publication = Publication::create($publicationArray);
            $publication->save();
            return $publication;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
