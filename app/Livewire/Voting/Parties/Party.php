<?php

namespace App\Livewire\Voting\Parties;

use Livewire\Component;
use App\Models\PoliticalParty;

class Party extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $party = PoliticalParty::find($this->id);
        return view('livewire.voting.parties.party', ['party' => $party])->layout('layouts.app', ['title' => $party->name]);
    }
}
