<?php

namespace App\Livewire\Campaign\Campaign;

use App\Constants\Audiences;
use App\Constants\CampaignStatus;
use App\Services\Campaign\CampaignService;
use Livewire\Component;

class EditCampaign extends Component
{
    public $breadcrumbs;
    public $campaign;

    public $campaignArray;
    public $audiences;
    public $campaignStatus;

    public $validate = [
        'campaignArray.tematica' => 'required',
        'campaignArray.descripcion' => 'required',
        'campaignArray.fecha_inicio' => 'required|date',
        'campaignArray.fecha_final' => 'required|date',
        'campaignArray.estado' => 'required',
        'campaignArray.invervalo' => 'nullable|numeric',
        'campaignArray.audiencia' => 'required',
        'campaignArray.presupuesto' => 'required|numeric',
        'campaignArray.objetivo' => 'required',
    ];

    public $message = [
        'campaignArray.tematica.required' => 'El campo temática es requerido',
        'campaignArray.descripcion.required' => 'El campo descripción es requerido',
        'campaignArray.fecha_inicio.required' => 'El campo fecha de inicio es requerido',
        'campaignArray.fecha_final.required' => 'El campo fecha final es requerido',
        'campaignArray.estado.required' => 'El campo estado es requerido',
        'campaignArray.audiencia.required' => 'El campo audiencia es requerido',
        'campaignArray.presupuesto.required' => 'El campo presupuesto es requerido',
        'campaignArray.objetivo.required' => 'El campo objetivo es requerido',
        'campaignArray.fecha_inicio.date' => 'El campo fecha de inicio debe ser una fecha',
        'campaignArray.fecha_final.date' => 'El campo fecha final debe ser una fecha',
        'campaignArray.invervalo.numeric' => 'El campo intervalo debe ser un número',
        'campaignArray.presupuesto.numeric' => 'El campo presupuesto debe ser un número',
    ];

    public function mount($campaign)
    {
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' => 'Editar', "url" => "campaign.edit", "id" => $campaign]
        ];
        $this->campaign = CampaignService::getOne($campaign);
        $this->audiences = Audiences::getAudiences();
        $this->campaignStatus = CampaignStatus::getCampaignStatus();
        $this->campaignArray = [
            'codigo' =>   $this->campaign->codigo,
            'tematica' =>   $this->campaign->tematica,
            'presupuesto' =>   $this->campaign->presupuesto,
            'audiencia' =>   $this->campaign->audiencia,
            'invervalo' =>   $this->campaign->invervalo,
            'fecha_inicio' =>   $this->campaign->fecha_inicio,
            'fecha_final' =>   $this->campaign->fecha_final,
            'objetivo' =>   $this->campaign->objetivo,
            'descripcion' =>   $this->campaign->descripcion,
            'estado' =>   $this->campaign->estado,
            'company_id' =>   $this->campaign->company_id,
        ];
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        CampaignService::update($this->campaign->id, $this->campaignArray);
        return redirect()->route('campaign.show', ['campaign' => $this->campaign->id]);
    }

    public function render()
    {
        return view('livewire.campaign.campaign.edit-campaign');
    }
}
