<?php

namespace App\Services\Campaign;

use App\Models\Campaign;

class CampaignService
{

    public function __construct()
    {
    }

    static public function getAll()
    {
        $campaigns = Campaign::all();
        return $campaigns;
    }

    static   public function getAllPaginate($attribute, $paginate, $order = "desc")
    {
        $campaigns = Campaign::where('tematica', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $campaigns;
    }

    static  public function getOne($id)
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

    static  public function update($id, $campaignArray)
    {
        try {
            $campaign = Campaign::find(intval($id));
            $campaign->update($campaignArray);
            return $campaign;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function delete($campaign)
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
