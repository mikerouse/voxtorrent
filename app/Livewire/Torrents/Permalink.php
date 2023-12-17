<?php

namespace App\Livewire\Torrents;

use Livewire\Component;
use App\Models\Torrent;
use App\Models\TorrentSigners;
use App\Models\User;
use Livewire\WithPagination;

/**
 * The permalink component is responsible for displaying a single torrent.
 * 
 */
class Permalink extends Component
{
    use WithPagination;
    public $torrent;
    public $currentPage = 1;
    public $itemsPerPage = 25;
    public $signatures = [];

    public function mount($torrentId)
    {
        $this->torrent = Torrent::find($torrentId);
        $this->loadSignatures();
    }

    public function loadSignatures()
    {
        $this->signatures = TorrentSigners::with('signer.primary_political_party')
            ->skip(($this->currentPage - 1) * $this->itemsPerPage)
            ->take($this->itemsPerPage)
            ->get()
            ->toArray();
    }

    public function goToPage($page)
    {
        $this->currentPage = $page;
        $this->loadSignatures();
    }

    public function render()
    {
        return view('livewire.torrents.permalink', ['torrent' => $this->torrent, 'signatures' => $this->signatures])->layout('layouts.app');
    }
}
