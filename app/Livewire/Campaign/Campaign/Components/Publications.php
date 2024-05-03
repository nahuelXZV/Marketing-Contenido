<?php

namespace App\Livewire\Campaign\Campaign\Components;

use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use Livewire\Component;
use Livewire\WithPagination;

class Publications extends Component
{
    use WithPagination;
    private $publicationService;
    public $campaign;
    public $search = '';


    public function mount($campaign)
    {
        $campaignService = new CampaignService();
        $this->campaign = $campaignService->getOne($campaign);
        $this->publicationService = new PublicationService();
    }

    public function render()
    {
        $publications = $this->publicationService->getAllByCampaignPaginate($this->campaign->id, $this->search, 10);
        return view('livewire.campaign.campaign.components.publications', compact('publications'));
    }
}
