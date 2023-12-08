<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DecisionMakers;
use Illuminate\Support\Facades\Log;
use App\Models\Constituency;
use App\Models\ConstituencyType;

class CreateTorrent extends Component
{
    // An array to hold the decision makers who will be the recipients of the torrent
    public $selectedDecisionMakers = [];
    // Whilst difficult to name a torrent as they are merely an encapsulation of desired human change in the world, we do need a name for the torrent for system management purposes
    public $name;
    // A description of the torrent - which is the desired human change in the world in more detail
    public $description;
    // This is a multi-step creation process
    // Step 1: Who do you want to target?
    // Step 2: What do you want them to do?
    // Step 3: Why do you want them to do it? Including an audio or video upload that explains the why.
    // Step 4: Who can help you build this torrent? Includoing a list of the most-engaged users (the influencers) and the most-engaged decision makers (the decision makers who have been most engaged with torrents of a similar nature in the past).
    // Step 4 is also where we enable the owner to share the torrent with their friends and family, and to share it on social media.
    public $step = 1;
    // This variable will hold the decision makers that are returned from the database, not the list of selected decision makers
    public $decisionMakers;
    // Not sure what this is for yet
    public $request;
    // An empty search field to start with
    public $search = '';
    // An array to hold the search results temporarily
    public $searchResults = [];

    public function mount()
    {
        $this->decisionMakers = DecisionMakers::all();
        $this->selectedDecisionMakers = [];
    }

    public function incrementStep()
    {
        $this->step++;
    }

    public function render()
    {
        switch ($this->step) {
            case 1:
                return view('livewire.create-torrent.step1')->layout('layouts.app');
            case 2:
                return view('livewire.create-torrent.step2', ['selectedDecisionMakers' => $this->selectedDecisionMakers])->layout('layouts.app');
            default:
                return view('livewire.create-torrent')->layout('layouts.app');
        }
    }

    public function performSearch()
    {
        if(strlen($this->search) >= 2) {
            $this->searchResults = DecisionMakers::where('display_name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->searchResults = [];
        }
    }

    public function addDecisionMaker($decisionMakerId)
    {
        if (count($this->selectedDecisionMakers) >= 10) {
            session()->flash('error', 'You can only add up to 10 decision makers at this time. We believe that this is the maximum number of decision makers that can be effectively targeted at once to avoid your message being diluted.');
            return;
        }
    
        $decisionMaker = DecisionMakers::findOrFail($decisionMakerId);
    
        if (!array_key_exists($decisionMakerId, $this->selectedDecisionMakers)) {
            $this->selectedDecisionMakers[$decisionMakerId] = [
                'id' => $decisionMaker->id,
                'display_name' => $decisionMaker->display_name,
                'thumbnail_url' => $decisionMaker->thumbnail_url,
                'constituency' => $decisionMaker->constituencies[0]->name,
                'constituency_type' => $decisionMaker->constituencies[0]->constituency_type->name,
            ];
            Log::info("Adding decision maker to recipient list: " . $this->selectedDecisionMakers[$decisionMakerId]['display_name']);
        }
    
        $this->onRefreshList(); 
    }

    public function onRefreshList()
    {
        // Handle the event
    }

    public function removeDecisionMaker($decisionMakerId)
    {
        unset($this->selectedDecisionMakers[$decisionMakerId]);
    }
    
    public function goToStep2()
    {
        $this->step++;
    }

    public function submitTorrent()
    {
        // Validation
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Store the torrent
        // ...

        // Redirect to the dashboard
        return redirect()->route('dashboard');
    }
}