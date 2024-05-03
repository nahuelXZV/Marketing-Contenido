<?php

namespace App\Services\Campaign;

use App\Models\Campaign;

class CampaignService
{

    public function __construct()
    {
    }

    public function getAll()
    {
        $campaigns = Campaign::all();
        return $campaigns;
    }

    public function getAllPaginate($attribute, $paginate, $order = "desc")
    {
        $campaigns = Campaign::where('tematica', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $campaigns;
    }

    public function getOne($id)
    {
        $campaign = Campaign::find($id);
        return $campaign;
    }

    static public function create($campaignArray)
    {
        try {
            $campaign = Campaign::create($campaignArray);
            $campaign->save();
            event(new \App\Events\CampaignCreated($campaign));
            return $campaign;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function update($id, $campaign)
    {
        try {
            $campaign = Campaign::find($id);
            $campaign->update($campaign);
            $campaign->save();
            return $campaign;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($campaign)
    {
        try {
            $campaign = Campaign::find($campaign);
            $campaign->delete();
            return $campaign;
        } catch (\Exception $e) {
            return false;
        }
    }
};
