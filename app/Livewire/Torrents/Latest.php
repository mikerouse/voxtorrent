<?php

namespace App\Livewire\Torrents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Torrent;
use Illuminate\Support\Facades\Auth;

class Latest extends Component
{
    use WithPagination;
    public $all;
    public $torrents;

    public function mount($all = false)
    {
        $this->all = $all;
        $this->torrents = Torrent::all();
    }

    public function render()
    {
        $torrents = $this->all ? Torrent::withCount('signatures')->paginate(10) : Torrent::where('owner_id', auth()->id())->paginate(10);
        return view('livewire.torrents.latest', compact('torrents'))->layout('layouts.app');
    }

}
