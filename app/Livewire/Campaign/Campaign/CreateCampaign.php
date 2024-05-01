<?php

namespace App\Livewire\Campaign\Campaign;

use App\Constants\Audiences;
use App\Constants\CampaignStatus;
use App\Services\Campaign\CampaignService;
use Livewire\Component;

class CreateCampaign extends Component
{
    public $breadcrumbs = [['title' => "Campañas", "url" => "campaign.list"], ['title' => "Crear", "url" => "campaign.create"]];
    public $campaignArray;
    public $audiences;

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

    public function mount()
    {
        $this->campaignArray = [
            'codigo' => now()->format('YmdHi'),
            'tematica' => '',
            'presupuesto' => '',
            'audiencia' => '',
            'invervalo' => '',
            'fecha_inicio' => '',
            'fecha_final' => '',
            'objetivo' => '',
            'descripcion' => '',
            'estado' => CampaignStatus::DRAFT,
            'company_id' => auth()->user()->company_id,
        ];
        $this->audiences = Audiences::getAudiences();
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        CampaignService::create($this->campaignArray);
        return redirect()->route('campaign.list');
    }

    public function render()
    {
        return view('livewire.campaign.campaign.create-campaign');
    }
}
