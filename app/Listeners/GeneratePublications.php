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
        try {
            $numberOfPublications = $this->getNumberOfPublications($campaign);
            $message = "Generame " . $numberOfPublications . " publicaciones para la campaña publicitaria con tematica de " . $campaign->tematica . ", con el objetivo de " . $campaign->objetivo . " y relacionado con " . $campaign->descripcion . ", dirigido a " . $campaign->audiencia . ".";
            $publications =  $this->openIAService->sendMenssage($message);
            $key = 0;
            foreach ($publications as $publication) {
                $this->savePublication($publication, $campaign, $key);
                $key += $this->getInterval($campaign);
            };
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function savePublication($publication, $campaign, $key)
    {
        $dataPublication = [
            'titulo' => $publication["titulo"],
            'contenido' =>  $publication["publicacion"],
            'descripcion_recurso' =>  $publication["propuesta_imagen"],
            'estado' => PublicationStatus::DRAFT,
            'campaign_id' => $campaign->id,
            'fecha_publicacion' => $this->getDatePublication($campaign,  $key),
            'hora_publicacion' => $this->getTimePublication($campaign, 0),
        ];
        PublicationService::create($dataPublication);
    }

    public function getNumberOfPublications($campaign)
    {
        $daysOfPublication = Carbon::parse($campaign->fecha_inicio)->diffInDays(Carbon::parse($campaign->fecha_final));
        $interval = $this->getInterval($campaign);
        if ($daysOfPublication === 0) {
            return 2;
        }
        $intervalTemp = $daysOfPublication / $interval;
        if ($intervalTemp < 2) {
            return 2;
        }
        $intervalTemp = (int)$intervalTemp;
        return $intervalTemp;
    }

    public function getInterval($campaign)
    {
        $intervalo = 1;
        if ($campaign['invervalo'] !== null) {
            return +$campaign['invervalo'];
        }
        return $intervalo;
    }

    public function getDatePublication($campaign, $index)
    {
        if ($index == 0)
            return $campaign->fecha_inicio;
        if ($campaign->fecha_inicio === $campaign->fecha_final)
            return $campaign->fecha_inicio;
        $fechaInicio = Carbon::parse($campaign->fecha_inicio);
        $fechaInicio->addDays($index);
        return $fechaInicio->format('Y-m-d');
    }

    public function getTimePublication($campaign, $index)
    {
        return '13:00';
    }
}
