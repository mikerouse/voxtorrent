<?php

namespace App\Livewire\DecisionMakers\Parliament;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DecisionMakers;

class Commons extends Component
{
    use WithPagination;

    public function mount()
    {
        
    }

    public function render()
    {
        $members = DecisionMakers::with('constituencies')
            ->where('hop_member_id', '!=', null)
            ->orderBy('last_name', 'asc')
            ->paginate(25);

        return view('livewire.decision-makers.parliament.commons', compact('members'))
            ->layout('layouts.app');
    }

}