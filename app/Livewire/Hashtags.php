<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hashtag;
use Livewire\WithPagination;

class Hashtags extends Component
{
    use WithPagination;

    public $all;

    public function mount($all = false)
    {
        $this->all = $all;
    }

    public function render()
    {
        $hashtags = Hashtag::withCount('torrents')->paginate(25);
        return view('livewire.hashtags.welcome', compact('hashtags'))->layout('layouts.app');
    }
}
