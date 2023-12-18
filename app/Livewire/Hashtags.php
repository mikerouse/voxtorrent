<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hashtag;
use Livewire\WithPagination;

class Hashtags extends Component
{
    use WithPagination;

    public $hashtags;

    public function mount()
    {
        $this->hashtags = Hashtag::withCount('torrents')->get()->sortByDesc('torrents_count');
    }

    public function render()
    {
        return view('livewire.hashtags.welcome')->layout('layouts.app');
    }
}
