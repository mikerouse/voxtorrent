<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Torrent;
use Illuminate\Support\Facades\Auth;

class TorrentList extends Component
{
    use WithPagination;
    public $all;

    public function mount($all = false)
    {
        $this->all = $all;
    }

    public function render()
    {
        $torrents = $this->all ? Torrent::withCount('signatures')->paginate(10) : Torrent::where('owner_id', auth()->id())->paginate(10);
        return view('livewire.torrents.latest', compact('torrents'))->layout('layouts.app');
    }

}
