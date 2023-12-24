<?php

namespace App\Livewire\Torrents\Components;

use Livewire\Component;

class CreateProgress extends Component
{
    public $stage;
    public $active;
    protected $listeners = ['stageUpdated' => 'updateStage'];

    public function mount($stage)
    {
        $this->stage = $stage;
    }

    public function updateStage($stage)
    {
        $this->stage = $stage;
        $this->active = $stage;
    }
    
    public function render()
    {
        return view('livewire.torrents.components.create-progress');
    }


}
