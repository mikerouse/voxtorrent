<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PublicProfile extends Component
{
    public function render()
    {
        return view('livewire.profile.public.php');
    }
}
