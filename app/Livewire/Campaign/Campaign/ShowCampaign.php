<?php

namespace App\Livewire\Campaign\Campaign;

use App\Services\Campaign\CampaignService;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCampaign extends Component
{
    use WithPagination;
    public $breadcrumbs = [];
    public $search = '';

    public $campaign;

    public function mount($campaign)
    {
        $campaignService = new CampaignService();
        $this->campaign = $campaignService->getOne($campaign);
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' => 'Ver', "url" => "campaign.show", "id" => $this->campaign->id]
        ];
    }

    public function render()
    {
        return view('livewire.campaign.campaign.show-campaign');
    }
}
