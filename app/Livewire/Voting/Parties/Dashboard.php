<?php

namespace App\Livewire\Voting\Parties;

use Livewire\Component;
use App\Models\PoliticalParty;

class Dashboard extends Component
{
    public $political_parties;

    public function mount()
    {
        $this->political_parties = PoliticalParty::all();
    }

    public function render()
    {
        return view('livewire.voting.parties.dashboard')->layout('layouts.app');
    }
}
