<?php

namespace App\Livewire\Campaign\Publication;

use App\Models\Publication;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use Livewire\Component;

class CreatePublication extends Component
{
    public $breadcrumbs;

    public $campaign;
    public $publicationArray;

    public $validate = [
        'publicationArray.titulo' => 'required',
        'publicationArray.contenido' => 'required',
        'publicationArray.descripcion_recurso' => 'required',
        'publicationArray.fecha_publicacion' => 'required|date',
        'publicationArray.hora_publicacion' => 'required',
        'publicationArray.presupuesto' => 'required|numeric',
    ];

    public $message = [
        'publicationArray.titulo.required' => 'El campo título es requerido',
        'publicationArray.contenido.required' => 'El campo contenido es requerido',
        'publicationArray.descripcion_recurso.required' => 'El campo descripción del recurso es requerido',
        'publicationArray.fecha_publicacion.required' => 'El campo fecha de publicación es requerido',
        'publicationArray.hora_publicacion.required' => 'El campo hora de publicación es requerido',
        'publicationArray.presupuesto.required' => 'El campo presupuesto es requerido',
        'publicationArray.fecha_publicacion.date' => 'El campo fecha de publicación debe ser una fecha',
        'publicationArray.presupuesto.numeric' => 'El campo presupuesto debe ser un número',
    ];

    public function mount($campaign)
    {
        $this->campaign = CampaignService::getOne($campaign);
        $this->publicationArray = [
            "codigo" => now()->format('YmdHi'),
            "titulo" => "",
            "contenido" => "",
            "descripcion_recurso" => "",
            "fecha_publicacion" => "",
            "hora_publicacion" => "",
            "presupuesto" => null,
            "campaign_id" => $this->campaign->id,
        ];
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' => $this->campaign->tematica, "url" => "campaign.show", "id" => $campaign],
            ['title' => 'Crear', "url" => "publication.create", "id" => $campaign]
        ];
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        PublicationService::create($this->publicationArray);
        return redirect()->route('campaign.show', $this->campaign->id);
    }

    public function render()
    {
        return view('livewire.campaign.publication.create-publication');
    }
}
