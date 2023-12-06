<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        return view('livewire.admin-dashboard', ['user' => $user])->layout('layouts.app');
    }
}
