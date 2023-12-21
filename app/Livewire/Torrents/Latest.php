<?php

namespace App\Livewire\Torrents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Torrent;

class Latest extends Component
{
    use WithPagination;

    public $all;

    public function mount($all = false)
    {
        $this->all = $all;
    }

    public function render()
    {
        $query = $this->all ? Torrent::withCount('signatures') : Torrent::where('is_blocked', false);
        $torrents = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('livewire.torrents.latest', compact('torrents'))->layout('layouts.app');
    }
}
