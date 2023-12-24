<?php

namespace App\Livewire\Debugger;

use Livewire\Component;

class Drawer extends Component
{
    protected $listeners = ['updateDebug' => 'handleUpdateDebug'];
    public $debug;
    public function mount()
    {
        $this->debug = [];
    }
    public function handleUpdateDebug($debugData)
    {
        $this->debug = $debugData;
    }
    public function render()
    {
        return view('livewire.debugger.drawer');
    }
}
