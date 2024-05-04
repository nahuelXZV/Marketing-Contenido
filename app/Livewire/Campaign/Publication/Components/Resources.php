<?php

namespace App\Livewire\Campaign\Publication\Components;

use App\Services\Campaign\PublicationService;
use App\Services\Campaign\ResourcePublicationService;
use Livewire\Attributes\On;
use Livewire\Component;

class Resources extends Component
{
    public $publication;
    public $resources;

    public function mount($publication)
    {
        $publicationService = new PublicationService();
        $this->publication = $publicationService->getOne($publication);
        $this->resources = ResourcePublicationService::getAllByPublication($this->publication->id);
    }

    #[On('resource-created')]
    public function refresh()
    {
        $this->resources = ResourcePublicationService::getAllByPublication($this->publication->id);
    }

    public function selectedResource($resource)
    {
        foreach ($this->resources as $r) {
            if ($r->id == $resource) {
                $r->selected = true;
            } else {
                $r->selected = false;
            }
            $r->save();
        }
    }

    public function render()
    {
        return view('livewire.campaign.publication.components.resources');
    }
}
