<?php

namespace App\Livewire\Torrents\Components;

use Livewire\Component;

class DecisionMakersDisplay extends Component
{
    public $torrent;

    public function mount($torrent)
    {
        $this->torrent = $torrent;
    }
    public function render()
    {
        return view('livewire.torrents.components.decision-makers-display');
    }
}
