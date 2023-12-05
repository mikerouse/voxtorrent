<?php

namespace App\Livewire\ConstituencyManager;

use Livewire\Component;

class Constituencies extends Component
{
    public function render()
    {
        return view('livewire.constituency-manager.constituencies')->layout('layouts.app');
    }
}
