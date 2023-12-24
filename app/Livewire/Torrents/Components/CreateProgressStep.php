<?php

namespace App\Livewire\Torrents\Components;

use Livewire\Component;

class CreateProgressStep extends Component
{
    public $stage = 1;
    public $active;
    public $isActiveStage = false;
    protected $listeners = ['updateStageProgress' => 'goToStage'];

    public function mount($stage, $isActiveStage)
    {
        $this->stage = $stage;
        $this->isActiveStage = $isActiveStage;
    }
    
    public function render()
    {
        return view('livewire.torrents.components.create-progress-step', [
            'isActiveStage' => $this->isActiveStage, 
            'active' => $this->active,
            'stage' => $this->stage
        ]);
    }

    public function isStageActive()
    {
        dd("isStageActive");
    }

    public function goToStage($stage)
    {
        $this->stage = $stage;
        $this->active = $stage;
        // we also need to set the property on the parent component
        $this->dispatch('stageUpdated', $stage);
        $this->render();
    }

}
