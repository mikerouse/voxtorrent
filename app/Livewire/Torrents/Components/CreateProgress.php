<?php

namespace App\Livewire\Torrents\Components;

use Livewire\Component;

class CreateProgress extends Component
{
    public $variables = [];
    public $stage;

    public function mount($variables)
    {
        foreach ($variables as $key => $value) {
            $this->$key = $value;
        }
    }
    
    public function render()
    {
        return view('livewire.torrents.components.create-progress');
    }


}
