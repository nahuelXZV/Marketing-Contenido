<?php

namespace App\Livewire\Campaign\Publication\Components;

use App\Constants\StylesDream;
use App\Services\Campaign\PublicationService;
use App\Services\Campaign\ResourcePublicationService;
use App\Services\Services\DreamIAService;
use Livewire\Component;

class GenerateImageModal extends Component
{
    public $publication;
    public $styles = [];
    public $options = [];

    public function mount($publication)
    {
        $publicationService = new PublicationService();
        $this->publication = $publicationService->getOne($publication);
        $this->styles = StylesDream::getStyles();
        $this->options = [
            "style" => 0,
            "prompt" => $this->publication->descripcion_recurso,
            "width" => "960",
            "height" => "960",
        ];
    }

    public function generateImage()
    {
        $dreamService = new DreamIAService();
        $stylesArray = StylesDream::getStylesArray();
        $this->options['style'] = $stylesArray[$this->options['style']];
        $response = $dreamService->generateImage($this->options);
        $resource = [
            "url_imagen" => $response['url'],
            'path' => $response['task_id'],
            "publication_id" => $this->publication->id,
        ];
        ResourcePublicationService::create($resource);
        $this->dispatch('resource-created');
    }

    public function resetOptions()
    {
        $this->options = [
            "style" => 0,
            "prompt" => $this->publication->descripcion_recurso,
            "width" => "960",
            "height" => "960",
        ];
    }

    public function render()
    {
        return view('livewire.campaign.publication.components.generate-image-modal');
    }
}
