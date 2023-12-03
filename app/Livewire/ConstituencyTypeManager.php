<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ConstituencyType;

class ConstituencyTypeManager extends Component
{
    public $constituencyTypes;
    public $name, $acronym, $constituencyType_id;
    public $isModalOpen = false;
    public function mount()
    {
        $this->constituencyTypes = ConstituencyType::all();
    }
    public function render()
    {
        return view('livewire.constituency-type-manager');
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
        $this->name = '';
        $this->acronym = '';
        $this->constituencyType_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'acronym' => 'required',
        ]);

        ConstituencyType::updateOrCreate(['id' => $this->constituencyType_id], [
            'name' => $this->name,
            'acronym' => $this->acronym,
        ]);

        session()->flash('message', 
            $this->constituencyType_id ? 'Constituency Type Updated Successfully.' : 'Constituency Type Created Successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $constituencyType = ConstituencyType::findOrFail($id);
        $this->constituencyType_id = $id;
        $this->name = $constituencyType->name;
        $this->acronym = $constituencyType->acronym;

        $this->openModal();
    }

    public function delete($id)
    {
        ConstituencyType::find($id)->delete();
        session()->flash('message', 'Constituency Type Deleted Successfully.');
    }
}
