<?php

namespace App\Livewire\Voting\Elections;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.voting.elections.dashboard')->layout('layouts.app', ['title' => 'elections dashboard']);
    }
}
