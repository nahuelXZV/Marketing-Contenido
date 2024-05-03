<?php

namespace App\Livewire\Campaign\Campaign\Components;

use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use Livewire\Component;

class Timeline extends Component
{
    public $campaign;
    public $publications;

    public function mount($campaign)
    {
        $campaignService = new CampaignService();
        $publicationService = new PublicationService();
        $this->campaign = $campaignService->getOne($campaign);
        $this->publications = $publicationService->getAllByCampaignTimeline($campaign);
    }

    public function render()
    {
        return view('livewire.campaign.campaign.components.timeline');
    }
}
