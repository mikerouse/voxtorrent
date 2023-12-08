<?php

namespace App\Livewire\DecisionMakers;

use Livewire\Component;
use App\Models\DecisionMakers;
use App\Models\Constituency;
use App\Models\ConstituencyType;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\User;
use App\Models\Torrent;

class Dashboard extends Component
{
    use WithPagination;
    public $decisionMakers;
    public $constituencies;
    public $torrents;
    public $users;

    public function render()
    {
        return view('livewire.decision-makers.dashboard')->layout('layouts.app');
    }
}