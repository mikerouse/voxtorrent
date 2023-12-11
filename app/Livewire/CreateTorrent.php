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
use Livewire\Attributes\Validate; 
use Livewire\Form;

class CreateTorrent extends Component
{
    // An array to hold the decision makers who will be the recipients of the torrent
    #[Validate('required')]
    public $selectedDecisionMakers = [];
    #[Validate('required')]
    public $hashtags = [];
    public $incomingHashtags = '';
    protected $listeners = [
        'updateHashtags' => 'setHashtags',
        'submitForm' => 'handleFormSubmission',
        'updateDescription' => 'updateDescription'
    ];
    public function setHashtags($incomingHashtags)
    {
        Log::info("Received hashtags: " . print_r($incomingHashtags, true));
        Log::info("Type of received hashtags: " . gettype($incomingHashtags));

        if (is_string($incomingHashtags)) {
            $hashtags = json_decode($incomingHashtags, true);

            if ($hashtags === null && json_last_error() !== JSON_ERROR_NONE) {
                Log::error("Failed to decode JSON: " . json_last_error_msg());
            } else {
                Log::info("Decoded hashtags: " . print_r($hashtags, true));
                Log::info("Type of decoded hashtags: " . gettype($hashtags));
                $this->hashtags = $hashtags;
            }
        } else {
            $this->hashtags = $incomingHashtags;
        }

        Log::info("Final hashtags: " . print_r($this->hashtags, true));
        Log::info("Type of final hashtags: " . gettype($this->hashtags));
    }
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
    #[Validate('required', onUpdate: false, message: 'Torrents cannot be blank')]
    public $torrentDescription;
    public $showSetTopicButton = false;
    public $isAiThinking = false;
    public $isAiThinking_message;
    public $AiDescriptionId;
    public $isFormValid = false;


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
        $this->incomingHashtags = '';
        $this->isFormValid = false;
    }

    public function updated()
    {
        Log::info('Component Updated', ['torrentDescription' => $this->torrentDescription]);
    }

    public function updateDescription($htmlContent)
    {
        $this->torrentDescription = $htmlContent;
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

    public function handleFormSubmission($data)
    {
        Log::info('Handling form submission');
        Log::info('Data: ' . print_r($data, true));
    }

    public function generateTorrentName()
    {
        $unixTime = time();
        $randomLetters = chr(rand(97, 122)) . chr(rand(97, 122)); // generates two random lowercase letters
    
        $this->torrentName = $unixTime . $randomLetters;
        Log::info('Generated torrent name: ' . $this->torrentName);
    }

    public function submitTorrent()
    {
        if (empty($this->torrentDescription)) {
            // We need a torrent content
            $this->dispatch('noDescription');
        }
        Log::info('Submitting torrent. Decision Makers: ' . json_encode($this->selectedDecisionMakers) . ', Torrent Description: ' . json_encode($this->torrentDescription) . ', Hashtags: ' . json_encode($this->hashtags));

        // Validation
        $this->validate(
            [
                'selectedDecisionMakers' => 'required',
                'hashtags' => 'required',
                'torrentDescription' => 'required',
            ]
        );



        // See Github issue #16 about the need to create a torrent name by using the hashtags and the decision makers and some random words
        $this->generateTorrentName();

        // Store the torrent
        $created_torrent = Torrent::create(
            [
                'name' => $this->torrentName,
                'description' => $this->torrentDescription,
                'decision_makers' => json_encode($this->selectedDecisionMakers),
                'hashtags' => json_encode($this->hashtags),
                'slug' => Str::slug($this->torrentName),
                'owner_id' => auth()->user()->id,
            ]
        );

        Log::info('Torrent created: ' . $this->torrentName);

        // Redirect to the dashboard
        $this->dispatch('torrent-created', id: $created_torrent->id);
    }
}