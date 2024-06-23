<?php

namespace App\Livewire\Campaign\Publication\Components;

use App\Constants\StylesDream;
use App\Services\Campaign\PublicationService;
use App\Services\Campaign\ResourcePublicationService;
use App\Services\Services\DreamIAService;
use App\Services\Services\OpenIAService;
use Livewire\Component;

class GenerateImageModal extends Component
{
    public $publication;
    public $styles = [];
    public $options = [];

    public $validate = [
        'options.style' => 'required',
        'options.prompt' => 'required',
        'options.width' => 'required',
        'options.height' => 'required',
    ];

    public $message = [
        'options.style.required' => 'El estilo es requerido',
        'options.prompt.required' => 'La descripción es requerida',
        'options.width.required' => 'El ancho es requerido',
        'options.height.required' => 'El alto es requerido',
    ];

    public function mount($publication)
    {
        $publicationService = new PublicationService();
        $this->publication = $publicationService->getOne($publication);
        $this->styles = StylesDream::getStyles();
        $this->options = [
            "style" => StylesDream::DALL_E,
            "prompt" => $this->publication->descripcion_recurso,
            "width" => "960",
            "height" => "960",
        ];
    }

    public function generateImage()
    {
        $this->validate($this->validate, $this->message);
        $openIAService = new OpenIAService();

        $stylesArray = StylesDream::getStylesArray();
        $this->options['style'] = $stylesArray[$this->options['style']];
        $this->options['prompt'] = $openIAService->translate($this->options['prompt']);
        $response = $this->getImage();
        $resource = [
            "url_imagen" => $response['url'],
            'path' => $response['task_id'],
            "publication_id" => $this->publication->id,
        ];

        ResourcePublicationService::create($resource);
        $this->dispatch('resource-created');
        $this->resetOptions();
    }

    public function getImage()
    {
        $dreamService = new DreamIAService();
        $openIAService = new OpenIAService();
        if ($this->options['style'] == 22) {
            return $openIAService->generateImage($this->options);
        }
        return  $dreamService->generateImage($this->options);
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
