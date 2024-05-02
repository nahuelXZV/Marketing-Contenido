<?php

namespace App\Livewire\Campaign\Campaign;

use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationService;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCampaign extends Component
{
    use WithPagination;
    public $breadcrumbs = [];
    public $search = '';

    private $campaignService;
    private $publicationService;

    public $campaign;

    public function mount($campaign)
    {
        $this->campaignService = new CampaignService();
        $this->publicationService = new PublicationService();
        $this->campaign = $this->campaignService->getOne($campaign);
        $this->breadcrumbs = [
            ['title' => "Campañas", "url" => "campaign.list"],
            ['title' => 'Ver', "url" => "campaign.show", "id" => $this->campaign->id]
        ];
    }

    public function generatePublications()
    {
        $this->campaignService = new CampaignService();
        $this->campaignService->generatePublications($this->campaign);
    }

    public function render()
    {
        $publications = $this->publicationService->getAllByCampaignPaginate($this->campaign->id, $this->search, 10);
        return view('livewire.campaign.campaign.show-campaign', compact('publications'));
    }
}
