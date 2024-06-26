<?php

namespace App\Livewire\Campaign\Campaign;

use App\Constants\Audiences;
use App\Constants\CampaignStatus;
use App\Services\Campaign\CampaignService;
use Livewire\Component;

class CreateCampaign extends Component
{
    public $breadcrumbs = [['title' => "Campañas", "url" => "campaign.list"], ['title' => "Crear", "url" => "campaign.create"]];
    protected $listeners = ['cleanerNotificacion'];

    public $campaignArray;
    public $audiences;
    public $notificacion = false;
    public $type = '';
    public $messageError = '';

    public $validate = [
        'campaignArray.tematica' => 'required',
        'campaignArray.descripcion' => 'required',
        'campaignArray.fecha_inicio' => 'required|date',
        'campaignArray.fecha_final' => 'required|date',
        'campaignArray.estado' => 'required',
        'campaignArray.invervalo' => 'nullable|numeric',
        'campaignArray.presupuesto' => 'required|numeric',
    ];

    public $message = [
        'campaignArray.tematica.required' => 'El campo temática es requerido',
        'campaignArray.descripcion.required' => 'El campo descripción es requerido',
        'campaignArray.fecha_inicio.required' => 'El campo fecha de inicio es requerido',
        'campaignArray.fecha_final.required' => 'El campo fecha final es requerido',
        'campaignArray.estado.required' => 'El campo estado es requerido',
        'campaignArray.presupuesto.required' => 'El campo presupuesto es requerido',
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
            'invervalo' => null,
            'fecha_inicio' => '',
            'fecha_final' => '',
            'descripcion' => '',
            'estado' => CampaignStatus::DRAFT,
            'company_id' => auth()->user()->company_id,
        ];
        $this->audiences = Audiences::getAudiences();
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        $status = CampaignService::create($this->campaignArray);
        if ($status) {
            return redirect()->route('campaign.list');
        } else {
            $this->messageError = 'Error al crear la campaña, Intente de nuevo mas tarde. o comuniquese con soporte';
            $this->type = 'error';
            $this->notificacion = true;
        }
    }

    public function cleanerNotificacion()
    {
        $this->notificacion = null;
        $this->messageError = '';
        $this->type = '';
    }

    public function render()
    {
        return view('livewire.campaign.campaign.create-campaign');
    }
}
