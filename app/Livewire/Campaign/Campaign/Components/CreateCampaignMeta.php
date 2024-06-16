<?php

namespace App\Livewire\Campaign\Campaign\Components;

use App\Constants\AdConfiguredStatusValues;
use App\Constants\CampaignObjectiveValues;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationConfigurationService;
use Livewire\Component;

class CreateCampaignMeta extends Component
{
    public $campaign;
    public $search = '';
    public $publicationConfigurationArray;
    public $objetives;
    public $statuses;

    public $validate = [
        'publicationConfigurationArray.name' => 'required',
        'publicationConfigurationArray.objective' => 'required',
        'publicationConfigurationArray.status' => 'required',
    ];

    public $message = [
        'publicationConfigurationArray.name.required' => 'El nombre es requerido',
        'publicationConfigurationArray.objective.required' => 'El objetivo es requerido',
        'publicationConfigurationArray.status.required' => 'El estado es requerido',
    ];

    public function mount($campaign)
    {
        $campaignService = new CampaignService();
        $this->campaign = $campaignService->getOne($campaign);
        $this->publicationConfigurationArray = [
            'name' => $this->campaign->tematica,
            'objective' => "",
            "status" => AdConfiguredStatusValues::PAUSED,
            "special_ad_categories" => [],
            "campaign_id" => $this->campaign->id,
        ];
        $this->statuses = AdConfiguredStatusValues::getAll();
        $this->objetives = CampaignObjectiveValues::getAll();
    }

    public function generateCampaign()
    {
        $this->validate($this->validate, $this->message);
        $publicationConfigurationService = new PublicationConfigurationService();
        $publicationConfigurationService->create($this->publicationConfigurationArray);
        $this->resetOptions();
        return redirect()->route('campaign.show', ['campaign' => $this->campaign->id]);
    }

    public function resetOptions()
    {
        $this->publicationConfigurationArray = [
            'name' => $this->campaign->tematica,
            'objective' => "",
            "status" => AdConfiguredStatusValues::PAUSED,
            "special_ad_categories" => [],
            "campaign_id" => $this->campaign->id,
        ];
    }

    public function render()
    {
        return view('livewire.campaign.campaign.components.create-campaign-meta');
    }
}
