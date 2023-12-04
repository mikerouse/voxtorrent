<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTable extends Component
{
    use WithPagination;
    protected $listeners = ['roleUpdated' => 'render'];
    public $roles;
    public $roleId, $name, $description, $self_selectable, $backend_management;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'self_selectable' => 'required|boolean',
        'backend_management' => 'required|boolean',
    ];
    public $isModalOpen = false;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.roles-table', [
            'roles' => Role::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->roleId = null;
        $this->name = '';
        $this->description = '';
        $this->self_selectable = false;
        $this->backend_management = false;
    }

    public function store()
    {
        $this->validate($this->rules);

        Role::updateOrCreate(['id' => $this->roleId], [
            'name' => $this->name,
            'description' => $this->description,
            'self_selectable' => $this->self_selectable,
            'backend_management' => $this->backend_management,
        ]);

        session()->flash('message', 
            $this->roleId ? 'Role Updated Successfully.' : 'Role Created Successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->name = $role->name;
        $this->description = $role->description;
        $this->self_selectable = $role->self_selectable;
        $this->backend_management = $role->backend_management;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', 'Role Deleted Successfully.');
    }

    
}
