<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Torrent;

class AllTorrentsList extends Component
{
    public function render()
    {
        $torrents = Torrent::withCount('signatures')->paginate(10);
        return view('livewire.all-torrents-list', compact('torrents'));
    }
}
