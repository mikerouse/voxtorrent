<?php

namespace App\Livewire\Torrents;

use Livewire\Component;
use App\Models\Torrent;

/**
 * The permalink component is responsible for displaying a single torrent.
 * 
 */
class Permalink extends Component
{
    public $torrent;

    public function mount($torrentId)
    {
        $this->torrent = Torrent::find($torrentId);
    }
    public function render()
    {
        return view('livewire.torrents.permalink', ['torrent' => $this->torrent])->layout('layouts.app');
    }
}
