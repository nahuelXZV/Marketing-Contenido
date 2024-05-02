<?php

namespace App\Livewire\Campaign\Campaign;

use App\Services\Campaign\CampaignService;
use Livewire\Component;
use Livewire\WithPagination;

class ListCampaign extends Component
{
    use WithPagination;
    protected $listeners = ['cleanerNotificacion'];
    private $campaignService;

    public $breadcrumbs = [['title' => "Campañas", "url" => "campaign.list"]];
    public $search = '';
    public $notificacion = false;
    public $type = '';
    public $message = '';

    public function mount()
    {
        $this->campaignService = new CampaignService();
    }

    public function cleanerNotificacion()
    {
        $this->notificacion = null;
        $this->search = '';
        $this->type = '';
    }

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        if ($this->campaignService->delete($id)) {
            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }
        $this->notificacion = true;
    }

    public function render()
    {
        $campaigns = $this->campaignService->getAllPaginate($this->search, 15);
        return view('livewire.campaign.campaign.list-campaign', compact('campaigns'));
    }
}
