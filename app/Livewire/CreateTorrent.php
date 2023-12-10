<?php

namespace App\Livewire;

use App\Jobs\AnalyseTorrentContent;
use Livewire\Component;
use App\Models\DecisionMakers;
use Illuminate\Support\Facades\Log;
use App\Models\Constituency;
use App\Models\ConstituencyType;
use App\Models\Torrent;
use Illuminate\Support\Facades\Http;
use App\Jobs\PopulateTorrentDescriptionJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CreateTorrent extends Component
{
    // An array to hold the decision makers who will be the recipients of the torrent
    public $selectedDecisionMakers = [];
    // Whilst difficult to name a torrent as they are merely an encapsulation of desired human change in the world, we do need a name for the torrent for system management purposes
    public $name;
    // A description of the torrent - which is the desired human change in the world in more detail
    public $description;
    // This variable will hold the decision makers that are returned from the database, not the list of selected decision makers
    public $decisionMakers;
    // Not sure what this is for yet
    public $request;
    // An empty search field to start with
    public $searchText = '';
    // An array to hold the search results temporarily
    public $searchResults = [];

    // When we get to Step 2 we start to populate the torrent 
    public $torrent;
    public $torrentName; 
    public $isTopicSet = false;
    public $torrentDescription;
    public $showSetTopicButton = false;
    public $isAiThinking = false;
    public $isAiThinking_message;
    public $AiDescriptionId;

    public $hashtags = [];

    public function mount()
    {
        $this->decisionMakers = DecisionMakers::all();
        $this->selectedDecisionMakers = [];
        $this->torrent = new Torrent();
        $this->torrentName;
        $this->isTopicSet = false;
        $this->torrentDescription;
        $this->isAiThinking = false;
        $this->isAiThinking_message = "Thinking...";
        $this->AiDescriptionId = (string) Str::uuid();
        $this->hashtags = [];
    }

    public function render()
    {
        return view('livewire.torrents.create')->layout('layouts.app');
    }

    public function performSearch()
    {
        if(strlen($this->searchText) >= 3) {
            $this->searchResults = DecisionMakers::where('display_name', 'like', '%' . $this->searchText . '%')
                ->get()
                ->map(function ($decisionMaker) {
                    $constituencies = $decisionMaker->constituencies->pluck('name')->join(', ');
                    $decisionMaker->constituencies_list = $constituencies;
                    return $decisionMaker;
                });
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
        $this->searchResults = [];
        $this->searchText = '';
        if (empty($this->searchText))
        {
            // The text is empty here, we just need to tell the blade that it's empty and refresh the view
            $this->dispatch('refresh');
        }
    }

    public function removeDecisionMaker($decisionMakerId)
    {
        unset($this->selectedDecisionMakers[$decisionMakerId]);
    }

    public function settingTopic()
    {
        $this->torrent->name = $this->torrentName;
        if (strlen($this->torrent->name) > 5) {
            $this->showSetTopicButton = true;
        } else {
            $this->showSetTopicButton = false;
        }
    }

    public function showSetTopicButton()
    {   
        $this->showSetTopicButton = !empty($this->torrent->name);
    }

    public function analyseTorrentContent()
    {
        $this->isAiThinking = true;
        
        if ($this->isAiThinking) {
            // We can do something whilst the AI is thinking
            $this->isAiThinking_message = "We are thinking about your torrent. This may take a few seconds.";
            $this->dispatch('AiThinking');
            // Dispatch the job
            AnalyseTorrentContent::dispatch($this, $this->torrentName, $this->AiDescriptionId);
            // Dispatch a browser event
            $this->dispatch('descriptionUpdateRequestSent');
        }
    }

    public function checkForCompletedAnalysis()
    {
        $this->isAiThinking = true;
        Log::info('Running checkForDescriptionUpdate for id: ' . $this->AiDescriptionId);
        $key = 'description_for_' . $this->AiDescriptionId;

        if (Cache::has($key)) {
            Log::info('Cache hit for key: ' . $key);
           
            $this->torrentDescription = Cache::get($key);
            $this->torrent->description = $this->torrentDescription;
        
            $this->dispatch('desriptionUpdateReceived');
            Log::info('Cache value: ' . $this->torrentDescription);

            $this->isAiThinking = false;
            Cache::forget($key); // Clear the cache entry
        }
        $this->isAiThinking = false;
    }

    public function submitTorrent()
    {
        // Validation
        $this->validate([
            'description' => 'required',
        ]);

        // Store the torrent
        // ...

        // Redirect to the dashboard
        return redirect()->route('dashboard');
    }
}