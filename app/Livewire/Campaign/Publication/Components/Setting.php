<?php

namespace App\Livewire\Campaign\Publication\Components;

use App\Constants\AdSetBillingEventValues;
use App\Constants\AdSetOptimizationGoalValues;
use App\Constants\AdSetStatusValues;
use App\Services\Campaign\AdSetsService;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationConfigurationService;
use App\Services\Campaign\PublicationService;
use App\Services\Campaign\ResourcePublicationService;
use Livewire\Component;

class Setting extends Component
{
    public $publication;
    public $campaign;
    public $adSet;
    public $publicationConfiguration;
    public $resources;
    public $resourceSelected;

    public $adSetArray = [];

    public $objetives = [];
    public $events = [];
    public $statuses = [];

    public $validate = [
        'adSetArray.name' => 'required',
        'adSetArray.optimization_goal' => 'required',
        'adSetArray.billing_event' => 'required',
        'adSetArray.bid_amount' => 'required',
        'adSetArray.daily_budget' => 'required',
        'adSetArray.targeting' => 'required',
        'adSetArray.start_time' => 'required',
        'adSetArray.end_time' => 'required',
        'adSetArray.status' => 'required',
        'adSetArray.link_redirect' => 'required',
        'resourceSelected' => 'required',
    ];
    public $message = [
        'adSetArray.name.required' => 'El nombre es requerido',
        'adSetArray.optimization_goal.required' => 'El objetivo de optimización es requerido',
        'adSetArray.billing_event.required' => 'El evento de facturación es requerido',
        'adSetArray.bid_amount.required' => 'El monto de oferta es requerido',
        'adSetArray.daily_budget.required' => 'El presupuesto diario es requerido',
        'adSetArray.targeting.required' => 'La audiencia es requerida',
        'adSetArray.start_time.required' => 'La fecha de inicio es requerida',
        'adSetArray.end_time.required' => 'La fecha final es requerida',
        'adSetArray.status.required' => 'El estado es requerido',
        'resourceSelected.required' => 'La imagen es requerida',
        'adSetArray.link_redirect' => 'El link de redirección es requerido',
    ];

    public function mount($publication)
    {
        $this->publication = PublicationService::getOne($publication);
        $this->campaign = CampaignService::getOne($this->publication->campaign_id);
        $this->publicationConfiguration = PublicationConfigurationService::getOneByCampaign($this->campaign->id);
        $this->adSet = AdSetsService::getOneByPublication($this->publication->id);
        $this->resources = ResourcePublicationService::getAllByPublication($this->publication->id);

        foreach ($this->resources as $resource) {
            if ($resource->selected) {
                $this->resourceSelected = $resource;
            }
        }

        if ($this->adSet != null && $this->publicationConfiguration != null) {
            $this->adSetArray = [
                'identificador' => $this->adSet->identificador,
                'name' => $this->adSet->nombre,
                'optimization_goal' => $this->adSet->objetivo_optimizacion,
                'billing_event' => $this->adSet->evento_facturacion,
                'bid_amount' => $this->adSet->monto_oferta,
                'daily_budget' => $this->adSet->presupuesto_diario,
                'targeting' => $this->adSet->audiencia,
                'start_time' => $this->adSet->fecha_inicio,
                'end_time' => $this->adSet->fecha_final,
                'status' => $this->adSet->estado,
                'link_redirect' => $this->publication->link_redirect,
                'campaign_id' => $this->publicationConfiguration->identificador,
            ];
        } else {
            $campaignId = $this->publicationConfiguration->identificador ?? '';
            $this->adSetArray = [
                'identificador' => '',
                'name' => $this->publication->titulo,
                'optimization_goal' => AdSetOptimizationGoalValues::REACH,
                'billing_event' => AdSetBillingEventValues::IMPRESSIONS,
                'bid_amount' => $this->publication->presupuesto,
                'daily_budget' => '',
                'targeting' => '{\"geo_locations\": {\"countries\":[\"BO\"]}}',
                'start_time' => $this->formatDate($this->publication->fecha_publicacion . ' ' . $this->publication->hora_publicacion),
                'end_time' =>  $this->formatDate($this->publication->fecha_publicacion . ' ' . $this->publication->hora_publicacion),
                'status' => AdSetStatusValues::PAUSED,
                'publication_id' => $this->publication->id,
                'link_redirect' => '',
                'campaign_id' => $campaignId,
            ];
        }
        $this->objetives = AdSetOptimizationGoalValues::getAll();
        $this->events = AdSetBillingEventValues::getAll();
        $this->statuses = AdSetStatusValues::getAll();
    }

    private function formatDate(string $date)
    {
        $date = explode(' ', $date);
        $date[0] = explode('-', $date[0]);
        $date[1] = explode(':', $date[1]);
        return $date[0][0] . '-' . $date[0][1] . '-' . $date[0][2] . 'T' . $date[1][0] . ':' . $date[1][1];
    }

    public function saveAdSet()
    {
        $this->validate($this->validate, $this->message);
        if ($this->adSet != null) {
            // Update
        } else {
            $adSetService = new AdSetsService();
            $adSetService->create($this->adSetArray, $this->resourceSelected, $this->publication->id);
        }
        return redirect()->route('publication.show', $this->publication->id);
    }

    public function render()
    {
        return view('livewire.campaign.publication.components.setting');
    }
}
