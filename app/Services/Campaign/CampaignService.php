<?php

namespace App\Services\System;

use App\Models\Campaign;

class CampaingService
{
    static public function getAll()
    {
        $campaigns = Campaign::all();
        return $campaigns;
    }

    static public function getAllPaginate($attribute, $paginate, $order = "desc")
    {
        $campaigns = Campaign::where('codigo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->where('tematica', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $campaigns;
    }

    static  public function getOne($id)
    {
        $campaign = Campaign::find($id);
        return $campaign;
    }

    static public function create($campaign)
    {
        try {
            $campaign = Campaign::create($campaign);
            $campaign->save();
            return $campaign;
        } catch (\Throwable $th) {
            return false;
        }
    }

    static public function update($id, $campaign)
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

    static  public function delete($campaign)
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
