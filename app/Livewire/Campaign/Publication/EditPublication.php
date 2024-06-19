<?php

namespace App\Livewire\Campaign\Publication;

use App\Constants\PublicationStatus;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use Livewire\Component;

class EditPublication extends Component
{
    public $breadcrumbs;
    public $publication;
    public $campaign;
    public $statuses;

    public $publicationArray;

    public $validate = [
        'publicationArray.titulo' => 'required',
        'publicationArray.contenido' => 'required',
        'publicationArray.descripcion_recurso' => 'required',
        'publicationArray.fecha_publicacion' => 'required|date',
        'publicationArray.hora_publicacion' => 'required',
        'publicationArray.presupuesto' => 'required|numeric',
        'publicationArray.estado' => 'required'
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
        'publicationArray.estado.required' => 'El campo estado es requerido'
    ];

    public function mount($publication)
    {
        $this->publication = PublicationService::getOne($publication);
        $this->campaign = CampaignService::getOne($this->publication->campaign_id);
        $this->publicationArray = [
            "codigo" => $this->publication->codigo,
            "titulo" => $this->publication->titulo,
            "contenido" => $this->publication->contenido,
            "descripcion_recurso" => $this->publication->descripcion_recurso,
            "fecha_publicacion" => $this->publication->fecha_publicacion,
            "hora_publicacion" => $this->publication->hora_publicacion,
            "presupuesto" => $this->publication->presupuesto,
            "campaign_id" => $this->publication->campaign_id,
            'estado' => $this->publication->estado ?? 'Borrador'
        ];
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' =>  $this->campaign->tematica, "url" => "campaign.show", "id" =>  $this->campaign->id],
            ['title' => 'Actualizar', "url" => "publication.edit", "id" => $publication]
        ];
        $this->statuses = PublicationStatus::getAll();
    }

    public function save()
    {
        $this->validate($this->validate, $this->message);
        PublicationService::update($this->publication->id, $this->publicationArray);
        return redirect()->route('campaign.show', $this->campaign->id);
    }

    public function render()
    {
        return view('livewire.campaign.publication.edit-publication');
    }
}
