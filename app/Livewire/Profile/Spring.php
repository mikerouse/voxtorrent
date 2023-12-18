<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\PoliticalParty;

/**
 * Because the framework I used already defined profile I've decided to call the user's public profile their 'Spring' because a river starts from a spring.
 * When the user is logged in they can see their spring and edit it.
 * When any user visits a page /{handle} they are sent here to view the public profile of the user with that handle.
 */
class Spring extends Component
{
    public $user;
    public $handle;
    public $owner = false;
    public $editing = false;
    public $bio;
    public $political_parties;
    public $primary_political_party_id;
    public function mount($handle)
    {
        $this->handle = $handle;
        $this->user = User::where('handle', $this->handle)->first();
        $this->political_parties = PoliticalParty::all();
    }
    public function render()
    {
        // Early return for guests
        if (Auth::guest()) {
            $this->owner = false;
            return view('livewire.profile.spring')->layout('layouts.app');
        }

        if ($this->user === null) {
            abort(404);
        }

        // Not a guest, so get the current logged-in user
        $user = Auth::user();

        // is this user looking at their own profile?
        if ($user->id === $this->user->id) {
            $this->owner = true;
            return view('livewire.profile.spring')->layout('layouts.app');
        } else {
            $this->owner = false;
            return view('livewire.profile.spring')->layout('layouts.app');
        }
        
    }

    public function editmode()
    {
        $this->editing = true;
    }

    public function updatebio()
    {
        $bio = $this->bio;
        $this->validate([
            'bio' => 'required',
        ]);
        $this->user->bio = $bio;
        $this->user->save();
        $this->editing = false;
        $this->dispatch('bio-updated', message: 'bio updated');
    }

    public function updateparty()
    {
        $this->validate([
            'primary_political_party_id' => 'required|exists:political_parties,id',
        ]);

        $this->user->primary_political_party_id = $this->primary_political_party_id;
        $this->user->save();

        $this->editing = false;
    }
    public function savechanges()
    {
        $this->validate([
            'user.name' => 'required',
            'user.handle' => 'required|unique:users,handle,' . $this->user->id,
            'user.bio' => 'required',
        ]);
        $this->user->save();
        $this->editing = false;
    }
}
