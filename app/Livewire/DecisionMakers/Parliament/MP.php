<?php

namespace App\Livewire\DecisionMakers\Parliament;

use Livewire\Component;
use App\Models\DecisionMakers;

class MP extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $mp = DecisionMakers::find($this->id);
        return view('livewire.decision-makers.parliament.m-p', ['mp' => $mp])->layout('layouts.app');
    }
}
