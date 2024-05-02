<?php

namespace App\Services\Campaign;

use App\Models\Publication;

class PublicationService
{

    public function get($id)
    {
        return Publication::find($id);
    }

    public function getAllByCampaign($campaignId)
    {
        return Publication::where('campaign_id', $campaignId)->get();
    }

    public function getAllByCampaignPaginate($campaignId, $search, $paginate)
    {
        return Publication::where('campaign_id', $campaignId)
            ->where('titulo', 'like', '%' . $search . '%')
            ->paginate($paginate);
    }

    public function create($publication)
    {
        try {
            $publication = Publication::create($publication);
            $publication->save();
            return $publication;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
