<?php

namespace App\Livewire\ConstituencyManager;

use Livewire\Component;
use App\Models\Constituency;
use App\Models\ConstituencyType;
use Illuminate\Support\Facades\Log;

class Constituencies extends Component
{
    public $nations;
    public $constituencies;
    public $constituencyTypes;
    public $constituency_id, $name, $nation, $population, $incumbent_party, $constituency_type;
    public $isModalOpen = false;
    public function mount()
    {
        $this->constituencies = Constituency::all();
        $this->constituencyTypes = ConstituencyType::all();
        $this->nations = config('constants.nations');
        $this->nation = '';
        $this->constituency_type;
    }
    public function render()
    {
        return view('livewire.constituency-manager.constituencies')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;

        Log::info("openModal");
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    
        Log::info("closeModal");
    }

    private function resetCreateForm(){
        $this->constituency_id = '';
        $this->name = '';
        $this->constituency_type = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'constituency_type' => 'required|exists:constituency_types,id',
            'nation' => 'required|in:'.implode(',', $this->nations),
            'population' => 'required|numeric',
            'incumbent_party' => 'required',
        ]);

        Constituency::updateOrCreate(['id' => $this->constituency_id], [
            'name' => $this->name,
            'constituency_type_id' => $this->constituency_type,
            'nation' => $this->nation,
            'population' => $this->population,
            'incumbent_party' => $this->incumbent_party,
        ]);

        session()->flash('message', 
            $this->constituency_id ? 'Constituency Updated Successfully.' : 'Constituency Created Successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $constituency = Constituency::findOrFail($id);
        $this->constituency_id = $id;
        $this->name = $constituency->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Constituency::find($id)->delete();
        session()->flash('message', 'Constituency Deleted.');
    }
}
