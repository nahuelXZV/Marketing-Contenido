<?php

namespace App\Livewire\System\Dashboard;

use App\Services\System\DashboardService;
use Livewire\Component;

class Home extends Component
{
    public $breadcrumbs = [['title' => "Home", "url" => ""]];
    public $cantUsers;
    public $cantCampaigns;
    public $cantPublications;

    public $users;
    public $campaigns;
    public $publications;
    public $contracts;

    public function render()
    {
        //cards
        $this->cantUsers = DashboardService::getCantidadUsers();
        $this->cantCampaigns = DashboardService::getCantidadCampaigns();
        $this->cantPublications = DashboardService::getCantidadPublications();

        //charts
        $this->users = DashboardService::getUsersByRole();
        $this->campaigns = DashboardService::getCampaignByTypes();
        $this->publications = DashboardService::getPublicationsByState();
        $this->contracts = DashboardService::getContractStatus();

        return view('livewire.system.dashboard.home');
    }
}
