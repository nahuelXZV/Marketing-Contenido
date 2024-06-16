<?php

namespace App\Livewire\Campaign\Campaign\Components;

use App\Services\Campaign\AdSetsService;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationConfigurationService;
use App\Services\Campaign\PublicationService;
use App\Services\Services\MetaService;
use Livewire\Component;

class Statistics extends Component
{
    public $campaign;
    public $publications;
    public $publicationConfiguration;
    public $adsets;
    public $insights;
    public $impressions;
    public $clicks;
    protected $listeners = ['updateStatistics'];

    public function mount($campaign)
    {
        $campaignService = new CampaignService();
        $publicationService = new PublicationService();
        $publicationConfigurationService = new PublicationConfigurationService();
        $adsetService = new AdSetsService();
        $this->campaign = $campaignService->getOne($campaign);
        $this->publications = $publicationService->getAllByCampaignTimeline($campaign);
        $this->publicationConfiguration = $publicationConfigurationService->getOneByCampaign($campaign);
        $this->adsets = $adsetService->getAllByCampaign($campaign);
        $this->updateStatistics();
    }

    private function processDataImpressions($data, $label, $type)
    {
        $estructure = [
            'label' => [],
            'data' => []
        ];
        foreach ($data as $key => $item) {
            if ($label == 'ad_name')
                array_push($estructure['label'], $item[$label]);
            else
                array_push($estructure['label'], $this->formatDate($item[$label]));
            array_push($estructure['data'], $item[$type]);
        }
        return $estructure;
    }


    private function formatDate($dateString)
    {
        $day = $dateString[8] . $dateString[9];
        $month = $dateString[5] . $dateString[6];
        $months = [
            '01' => 'ene',
            '02' => 'feb',
            '03' => 'mar',
            '04' => 'abr',
            '05' => 'may',
            '06' => 'jun',
            '07' => 'jul',
            '08' => 'ago',
            '09' => 'sep',
            '10' => 'oct',
            '11' => 'nov',
            '12' => 'dic',
        ];
        return $day . ' ' . $months[$month];
    }

    public function updateStatistics()
    {
        $metaService = new MetaService();
        $this->insights = $metaService->getInsightsByCampaign($this->publicationConfiguration->identificador);
        $this->impressions =  $this->processDataImpressions($this->insights, 'date_start', 'impressions');
        $this->clicks =  $this->processDataImpressions($this->insights, 'ad_name', 'clicks');
    }

    public function render()
    {
        return view('livewire.campaign.campaign.components.statistics');
    }
}
