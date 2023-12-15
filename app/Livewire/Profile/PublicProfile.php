<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PublicProfile extends Component
{
    public $handle;
    public $location;
    public $bio;

    protected $rules = [
        'handle' => 'required|string|max:80',
        'location' => 'required|string|max:255',
        'bio' => 'required|string|max:1024',
    ];
    public function mount(User $user)
    {
        
    }

    public function render()
    {
        $user = Auth::user();
        $this->handle = $user->handle;
        $this->location = $user->location;
        $this->bio = $user->bio;
        return view('livewire.profile.public-profile', compact('user'))->layout('layouts.app');
    }

    public function updatePublicProfile()
    {
        $this->validate();
        $user = Auth::user();
        // Update the user's public profile fields
        $user->handle = $this->handle;
        $user->location = $this->location;
        $user->bio = $this->bio;
        $user->save();

        session()->flash('message', 'Public profile information updated.');
        $this->dispatch('public-profile-updated');
        return redirect()->to('/profile');
    }
}
