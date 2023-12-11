<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Torrent;

use function Livewire\Volt\layout;

class AllTorrentsList extends Component
{
    use WithPagination;
    public $torrents;

    public function mount()
    {
        $this->torrents = Torrent::all();
    }
    public function render()
    {
        $torrents = Torrent::withCount('signatures')->paginate(25);
        return view('livewire.torrents.all-torrents-list', compact('torrents'))->layout('layouts.app');
    }
}
