<?php

namespace App\Livewire\Campaign\Publication;

use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowPublication extends Component
{
    public $breadcrumbs = [];

    public $campaign;
    public $publication;

    public function mount($publication)
    {
        $campaignService = new CampaignService();
        $publicationService = new PublicationService();
        $this->publication = $publicationService->getOne($publication);
        $this->campaign = $campaignService->getOne($this->publication->campaign_id);
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' => 'Ver', "url" => "campaign.show", "id" => $this->campaign->id],
            ['title' => 'Publicaciones', "url" => "publication.show", "id" => $this->publication->id]
        ];
    }

    public function render()
    {
        return view('livewire.campaign.publication.show-publication');
    }
}
