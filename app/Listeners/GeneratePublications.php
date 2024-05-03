<?php

namespace App\Listeners;

use App\Constants\PublicationStatus;
use App\Events\CampaignCreated;
use App\Services\Campaign\PublicationService;
use App\Services\Services\OpenIAService;
use Carbon\Carbon;

class GeneratePublications
{
    private $openIAService;
    private $publicationService;
    public function __construct()
    {
        //
    }

    public function handle(CampaignCreated $event): void
    {
        $this->generatePublications($event->campaign);
    }

    public function generatePublications($campaign)
    {
        $this->openIAService = new OpenIAService();
        $this->publicationService = new PublicationService();
        try {
            $numberOfPublications = $this->getNumberOfPublications($campaign);
            $message = "Generame " . $numberOfPublications . " publicaciones para la campaña publicitaria con tematica de " . $campaign->tematica . ", con el objetivo de " . $campaign->objetivo . " y relacionado con " . $campaign->descripcion . ", dirigido a " . $campaign->audiencia . ".";

            $responseOpenIA =  $this->openIAService->sendMenssage($message);
            if ($responseOpenIA && is_array($responseOpenIA['choices'])) {
                $responseString = $responseOpenIA['choices'][0]['message']['content'];
                $responseString = preg_replace('/\\\\u([0-9a-fA-F]{4})/', '&#x$1;', $responseString);
                $publications = json_decode($responseString, true);
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
        $intervalo = 3;
        if ($campaign->intervalo !== null) {
            $intervalo = $campaign->intervalo;
        }
        if ($daysOfPublication === 0) {
            return 1;
        }
        return $daysOfPublication / $intervalo;
    }
}
