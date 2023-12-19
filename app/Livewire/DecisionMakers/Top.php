<?php

namespace App\Livewire\DecisionMakers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DecisionMakers;

class Top extends Component
{
    use WithPagination;
    public function render()
    {
        $influencers = DecisionMakers::with('torrents')
            ->withCount('torrents')
            ->orderBy('torrents_count', 'desc')
            ->paginate(25);

        return view('livewire.decision-makers.top', compact('influencers'))->layout('layouts.app');

    }
}
