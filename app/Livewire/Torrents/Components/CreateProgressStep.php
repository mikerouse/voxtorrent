<?php

namespace App\Livewire\Torrents\Components;

use Livewire\Component;

class CreateProgressStep extends Component
{
    public $stage = 1;
    public $isActiveStage = false;

    public function mount($stage, $isActiveStage)
    {
        $this->stage = $stage;
        $this->isActiveStage = $isActiveStage;
    }
    
    public function render()
    {
        return view('livewire.torrents.components.create-progress-step');
    }

    public function isActiveStage()
    {
        // Logic to determine if the stage is active
        return $this->isActiveStage;
    }

    public function goToStage($stage)
    {
        $this->stage = $stage;
        // we also need to set the property on the parent component
        $this->dispatch('goToStage', $stage);
    }

}
