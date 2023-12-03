<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;
use Illuminate\Contracts\View\View;

class EditRole extends Component
{
    public Role $role;

    public function mount(Role $role)
    {
        $this->role = $role;
    }
    public function render()
    {
        return view('livewire.edit-role');
    }
    public function save()
    {
        $this->validate([
            'role.name' => ['required', 'string', 'max:255'],
            'role.description' => ['nullable', 'string', 'max:255'],
            'role.self_selectable' => ['boolean'],
            'role.backend_management' => ['boolean'],
        ]);

        $this->role->save();

        session()->flash('message', 'Role updated successfully.');

        return redirect()->route('manage-roles.index');
    }

}
