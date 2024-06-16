<?php

namespace App\Services\Campaign;

use App\Models\AdSets;
use App\Models\PublicationConfiguration;
use App\Services\Services\MetaService;

class AdSetsService
{

    static public function getOne($id)
    {
        return AdSets::find($id);
    }

    static public function getOneByPublication($publicationId)
    {
        return AdSets::where('publication_id', $publicationId)->first();
    }

    static public function create($adSetArray, $resource, $publicationId)
    {
        try {
            $publication = PublicationService::getOne($publicationId);
            $metaService = new MetaService();

            // create adset
            $adSetId = $metaService->createAdSet($adSetArray);
            $adSet = AdSets::create([
                'identificador' => $adSetId,
                'nombre' => $adSetArray['name'],
                'objetivo_optimizacion' => $adSetArray['optimization_goal'],
                'evento_facturacion' => $adSetArray['billing_event'],
                'monto_oferta' => $adSetArray['bid_amount'],
                'presupuesto_diario' => $adSetArray['daily_budget'],
                'audiencia' => $adSetArray['targeting'],
                'fecha_inicio' => $adSetArray['start_time'],
                'fecha_final' => $adSetArray['end_time'],
                'estado' => $adSetArray['status'],
                'publication_id' => $adSetArray['publication_id'],
            ]);
            $adSet->save();

            // Upload image to facebook
            $image = $metaService->createAdimages($resource);
            $resourceUpdate = ResourcePublicationService::getOne($resource->id);
            $resourceUpdate->meta_hash = $image['hash'];
            $resourceUpdate->meta_url = $image['hash'];
            $resourceUpdate->save();

            // create creative
            $creativeId = $metaService->createCreative([
                "name" => $publication->titulo,
                "image_hash" => $image['hash'],
                "link" => $adSetArray['link_redirect'],
                "message" => $publication->contenido,
            ]);
            $publication->link_redirect = $adSetArray['link_redirect'];
            $publication->identicador_creativo = $creativeId;
            $publication->save();

            return true;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
