<?php

namespace App\Livewire;

use Livewire\Component;

class CreateTorrent extends Component
{
    public $name;
    public $description;
    public $step = 1;
    public $decisionMakers;
    public $request;

    public function incrementStep()
    {
        $this->step++;
    }

    public function render()
    {
        switch ($this->step) {
            case 1:
                return view('livewire.create-torrent.step1')->layout('layouts.app');
            case 2:
                return view('livewire.create-torrent.step2')->layout('layouts.app');
            default:
                return view('livewire.create-torrent')->layout('layouts.app');
        }
    }

    public function submit()
    {
        // Validation
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Store the torrent
        // ...

        // Redirect to the dashboard
        return redirect()->route('dashboard');
    }
}