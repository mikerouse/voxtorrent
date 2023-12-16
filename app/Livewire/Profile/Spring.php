<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

/**
 * Because the framework I used already defined profile I've decided to call the user's public profile their 'Spring' because a river starts from a spring.
 * When the user is logged in they can see their spring and edit it.
 * When any user visits a page /{handle} they are sent here to view the public profile of the user with that handle.
 */
class Spring extends Component
{
    public $user;
    public $handle;
    public function mount($handle)
    {
        $this->handle = $handle;
        $this->user = User::where('handle', $this->handle)->first();
    }
    public function render()
    {
        // Early return for guests
        if (Auth::guest()) {
            return view('livewire.profile.spring')->layout('layouts.app');
        }

        if ($this->user === null) {
            abort(404);
        }

        // Not a guest, so get the user
        $user = $this->user;

        // if the user has not set various required profile fields we need to redirect them to the appropriate page to set those details
        if (empty($user->location) || empty($user->bio)) {
            $this->redirect('/profile');
        }

        // If the user is viewing their own spring, show the edit form or at least additional controls
        if ($user->id === $this->user->id) {
            return view('livewire.profile.spring')->layout('layouts.app');
        }

        // If the user is not viewing their own spring, show the public profile
        return view('livewire.profile.spring')->layout('layouts.app');
    }
}
