<?php

namespace App\Livewire\Torrents;

use Livewire\Component;
use App\Models\Torrent;
use App\Models\TorrentSigners;
use App\Models\User;
use App\Models\PoliticalParty;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    public $selectedDecisionMakers;
    public $torrent;
    public $isFormValid = false;
    public $hashtags;

    public function mount($torrentId)
    {
        $this->torrent = Torrent::find($torrentId);
    }
    public function render()
    {
        // @todo: fix the bug that allows torrents to be created without any decision makers.
        if ($this->torrent->decisionMakers == null || $this->torrent->decisionMakers->count() == 0) 
        {
            Log::debug('No decision makers found for torrent ' . $this->torrent->id);
            $this->selectedDecisionMakers = [];
        } else {
            $this->selectedDecisionMakers = $this->torrent->decisionMakers->pluck('id')->toArray();
        }
        return view('livewire.torrents.edit', ['torrent' => $this->torrent])->layout('layouts.app');
    }
}
