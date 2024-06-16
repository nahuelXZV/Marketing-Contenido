<?php

namespace App\Livewire\Campaign\Publication\Components;

use App\Constants\AdPreviewAdFormatValues;
use App\Services\Campaign\PublicationService;
use App\Services\Services\MetaService;
use Livewire\Component;

class Statistics extends Component
{
    public $publication;
    public $metaService;
    public $formats = [];
    public $formatSelected;

    public function mount($publication)
    {
        $this->publication = PublicationService::getOne($publication);
        $this->formats = AdPreviewAdFormatValues::getAll();
        $this->formatSelected = AdPreviewAdFormatValues::DESKTOP_FEED_STANDARD;
    }

    public function render()
    {
        $metaService = new MetaService();
        if ($this->publication->identicador_creativo == null)
            $inner = null;
        else
            $inner = $metaService->preview($this->publication->identicador_creativo, $this->formatSelected);
        return view('livewire.campaign.publication.components.statistics', compact('inner'));
    }
}
