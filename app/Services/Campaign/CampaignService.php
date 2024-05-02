<?php

namespace App\Services\Campaign;

use App\Constants\PublicationStatus;
use App\Models\Campaign;
use App\Services\Services\OpenIAService;
use Illuminate\Support\Carbon;

class CampaignService
{
    private $openIAService;
    private $publicationService;

    public function __construct()
    {
        $this->openIAService = new OpenIAService();
        $this->publicationService = new PublicationService();
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

    public function create($campaign)
    {
        try {
            $campaign = Campaign::create($campaign);
            $campaign->save();
            $this->generatePublications($campaign);
            return $campaign;
        } catch (\Throwable $th) {
            return false;
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

    public function generatePublications($campaign)
    {
        $this->openIAService = new OpenIAService();
        try {
            $numberOfPublications = $this->getNumberOfPublications($campaign);
            $message = "Generame " . $numberOfPublications . " publicaciones para la campaña publicitaria con tematica de " . $campaign->tematica . ", con el objetivo de " . $campaign->objetivo . " y relacionado con " . $campaign->descripcion . ", dirigido a " . $campaign->audiencia . ".";

            $responseOpenIA =  $this->openIAService->sendMenssage($message);
            if ($responseOpenIA && is_array($responseOpenIA['choices'])) {
                $responseString = $responseOpenIA['choices'][0]['message']['content'];
                $responseString = preg_replace('/\\\\u([0-9a-fA-F]{4})/', '&#x$1;', $responseString);
                $publications = json_decode($responseString, true);
                if (!is_array($publications)) {
                    throw new \Exception("Error al generar las publicaciones");
                }
                foreach ($publications as $publication) {
                    $dataPublication = [
                        'titulo' => $publication["titulo"],
                        'contenido' =>  $publication["publicacion"],
                        'descripcion_recurso' =>  $publication["propuesta_imagen"],
                        'estado' => PublicationStatus::DRAFT,
                        'campaign_id' => $campaign->id,
                    ];
                    $this->publicationService->create($dataPublication);
                };
                return true;
            } else {
                throw new \Exception("Error al generar las publicaciones");
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getNumberOfPublications($campaign)
    {
        $daysOfPublication = Carbon::parse($campaign->fecha_inicio)->diffInDays(Carbon::parse($campaign->fecha_final));
        $intervalo = intval($campaign->invervalo ?? 2);
        // return $daysOfPublication / $intervalo;
        return 2;
    }
};
