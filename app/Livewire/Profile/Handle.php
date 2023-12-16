<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class Handle extends Component
{
    public $user;
    public $handle;

    protected $rules = [
        'handle' => 'required|string|max:80',
    ];

    public function mount(User $user)
    {
        if (Auth::guest()) {
            abort(403);
        }
 
        $this->user = $user;
    }
    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.profile.handle')->layout('layouts.app');
    }

    public function setHandle()
    {
        $user = Auth::user();

        $this->validate([
            'handle' => 'required|string|max:80|unique:users,handle,' . $user->id,
        ]);

        $user->handle = $this->handle;
        $user->save();

        session()->flash('message', 'Handle updated.');
        $this->dispatch('handle-updated');
        return redirect()->to('/latest');
    }
}
