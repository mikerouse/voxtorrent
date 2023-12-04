<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ManageRoles extends Component
{
    public $userRoles = [];
    public $allRoles = [];

    protected $rules = [
        'userRoles' => 'required|array',
        'userRoles.*' => 'required|integer|exists:roles,id',
    ];

    public function mount(User $user)
    {
        $this->allRoles = Role::orderBy('name')->get();
        $this->userRoles = $user->roles->pluck('id')->toArray();

        // If the current user is not a 'System Administrator' and there are other users in the system, remove that role from $allRoles
        if (!in_array('System Administrator', $user->roles->pluck('name')->toArray()) && User::count() > 1) {
            $this->allRoles = $this->allRoles->filter(function ($role) {
                return $role->name !== 'System Administrator';
            });
        }
    }

    public function updateRoles()
    {
        $this->validate();

        $user = Auth::user();
        $user->roles()->sync($this->userRoles);

        session()->flash('message', 'Roles updated successfully.');
        return redirect()->to('/profile');
    }

    public function render()
    {
        return view('livewire.profile.manage-roles');
    }
}
