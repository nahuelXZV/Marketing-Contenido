<?php

namespace App\Livewire\Campaign\Campaign\Components;

use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationConfigurationService;
use Livewire\Component;
use Livewire\WithPagination;

class ConfigurationMeta extends Component
{
    use WithPagination;
    private $publicationService;
    public $publicationConfiguration;
    public $campaign;
    public $search = '';

    public function mount($campaign)
    {
        $campaignService = new CampaignService();
        $publicationConfigurationService = new PublicationConfigurationService();
        $this->campaign = $campaignService->getOne($campaign);
        $this->publicationConfiguration = $publicationConfigurationService->getOneByCampaign($campaign);
    }

    public function render()
    {
        return view('livewire.campaign.campaign.components.configuration-meta');
    }
}
