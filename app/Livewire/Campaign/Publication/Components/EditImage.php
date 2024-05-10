<?php

namespace App\Livewire\Campaign\Publication\Components;

use App\Models\Resource;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use App\Services\Campaign\ResourcePublicationService;
use Livewire\Component;

class EditImage extends Component
{
    public $breadcrumbs;
    private $urlImgix;

    public $resource;
    public $publication;
    public $campaign;
    public $oldImage;
    public $newImage;

    public $options;
    public $fitOptions = ["clamp", "clip", "crop", "facearea", "fill", "fillmax", "max", "min", "scale"];
    public $autoOptions = ['true', 'compress', 'enhance', 'format'];
    public $formatOptions = ['avif', 'jpg', 'png', 'webm', 'webp', 'mp4'];

    public function mount($resource)
    {
        $this->resource = ResourcePublicationService::getOne($resource);
        $this->publication = PublicationService::getOne($this->resource->publication_id);
        $this->campaign = CampaignService::getOne($this->publication->campaign_id);
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' => $this->campaign->tematica, "url" => "campaign.show", "id" =>   $this->campaign->id],
            ['title' => $this->publication->titulo, "url" => "publication.show", "id" =>   $this->publication->id],
            ['title' => 'Editar Imagen', "url" => "publication.edit.image", "id" => $resource]
        ];
        $this->oldImage = $this->resource->url_imagen;
        $this->newImage = $this->resource->url_imagen;
        $this->options = [
            'auto' => null, // auto enhance
            'h' => 960, // height
            'w' => 960, // width
            'q' => 90, // quality 0 to 100
            'fm' => null, // format
            'mark' => null, // watermark nameImage
            'fit' => "clip", // fit
            'con' => null, // contrast  -100 to 100
            'exp' => null, // exposure  -100 to 100
            'sat' => null, // saturation -100 to 100
            'vib' => null, // vibrance -100 to 100
            'blur' => null, // blur 0 to 2000
            'transparency' => null, // transparency grid to null
        ];
    }

    public function generate()
    {
        $this->urlImgix = config('services.imgix.url');
        $optionsString = $this->getOptionsString();
        $pathImgix = ResourcePublicationService::getPathImage($this->oldImage);
        $this->newImage = $this->urlImgix . $pathImgix . '?' . $optionsString;
    }


    public function getOptionsString()
    {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value == null || $value == "" || $value == 'null') {
                continue;
            }
            $options[] = $key . '=' . $value;
        }
        return implode('&', $options);
    }

    public function render()
    {
        return view('livewire.campaign.publication.components.edit-image');
    }
}
