<?php

namespace App\Livewire\ConstituencyManager;

use Livewire\Component;
use App\Models\ConstituencyType;
use App\Models\Constituency;

class Dashboard extends Component
{
    public function render()
    {
        $constituencyCount = Constituency::count();
        $constituencyTypeCount = ConstituencyType::count();
    
        return view('livewire.constituency-manager.dashboard', [
            'constituencyCount' => $constituencyCount,
            'constituencyTypeCount' => $constituencyTypeCount,
        ])->layout('layouts.app');
    }
}
