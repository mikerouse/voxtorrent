<?php

namespace App\Livewire;

use App\Jobs\AnalyseTorrentContent;
use Livewire\Component;
use App\Models\DecisionMakers;
use Illuminate\Support\Facades\Log;
use App\Models\Constituency;
use App\Models\ConstituencyType;
use App\Models\Hashtags;
use App\Models\Torrent;
use Illuminate\Support\Facades\Http;
use App\Jobs\PopulateTorrentDescriptionJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate; 
use Livewire\Form;
use App\Insert\HashtagInsert;
use WireElements\Pro\Icons\Hashtag;

class CreateTorrent extends Component
{
    // An array to hold the decision makers who will be the recipients of the torrent
    #[Validate('required')]
    public $selectedDecisionMakers = [];
    #[Validate('required')]
    public $hashtags = [];
    public $incomingHashtags = '';
    protected $listeners = [
        'submitForm' => 'handleFormSubmission',
        'updateDescription' => 'updateDescription',
        'createNewHashtag' => 'handleNewHashtag',
    ];

    public function handleNewHashtag($query)
    {
        // Check that the query is a string - it should be - and make sure it is a string
        if (!is_string($query)) {
            Log::info('Query is not a string: ' . $query);
            return;
        }

        // Now we need to check that the hashtag does not already exist in the database
        // If it does already exist by 'name' then return early
        if (Hashtags::where('name', $query)->exists()) {
            Log::info('Hashtag already exists in the database: ' . $query);
            return;
        }

        // First, we need to make sure the we strip any starting '#' from the query if there is one
        $query = ltrim($query, '#');
        // Next, trim any whitespace.
        $query = trim($query);
        // Next, make everything lowercase
        $query = strtolower($query);
        
        $this->saveNewHashtag($query);

        // dispatch an event back to the browser to update the hashtag list
        $this->dispatch('hashtagCreated', $query);
    }

    public function setHashtags(array $incomingHashtags = [])
    {
        
        $this->hashtags = $incomingHashtags;
        
        foreach ($this->hashtags as $hashtag) {
            // Log::info("Hashtag: " . $hashtag);
            $this->saveNewHashtag($hashtag);
        }
        
    }

    public function saveNewHashtag($hashtag)
    {
        // Invoke the Hashtags class and save a new Hashtag to the database 
        $newHashtag = Hashtags::create(
            [
                'name' => $hashtag,
                'slug' => Str::slug($hashtag),
                'description' => 'This is a new hashtag. Edit the description to add more information.',
                'creator_id' => auth()->user()->id,
                'weight' => 0,
                'views' => 0,
                'likes' => 0,
                'shares' => 0,
                'dislikes' => 0,
                'flags' => 0,
                'is_blocked' => false,
                'is_sensitive' => false,
                'is_trash' => false,
                'is_featured' => false,
            ]
        );
        Log::info('Saved new hashtag: ' . $hashtag . ' with slug: ' . $newHashtag->slug . ' to the database with ID '. $newHashtag->id);
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

    // public function handleSpacebar($hashtags)
    // {
    //     Log::info('Handling spacebar', ['hashtags' => $hashtags]);
    
    //     // Ensure we have a non-empty string, then explode, trim, and filter
    //     if (is_string($hashtags) && trim($hashtags) !== '') {
    //         $hashtagsArray = array_filter(array_map('trim', explode(' ', $hashtags)));
    //     } else {
    //         $hashtagsArray = [];
    //     }
    
    //     Log::info('Processed Hashtags: ' . print_r($hashtagsArray, true));
    
    //     foreach ($hashtagsArray as $hashtag) {
    //         $hashtag = '#' . ltrim($hashtag, '#'); // Ensure each hashtag starts with '#'
    //         Log::info('Processing Hashtag: ' . $hashtag);
    
    //         if (!in_array($hashtag, $this->hashtags)) {
    //             $this->hashtags[] = $hashtag;
    //         } else {
    //             Log::info('Hashtag already in array: ' . $hashtag);
    //         }
    //     }
    
    //     Log::info('Finalised array values: ' . print_r($this->hashtags, true));
    // }

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

    public function isFormValid()
    {
        // Check we have an array of decision makers, a torrent description and hashtags
        if (empty($this->selectedDecisionMakers) || empty($this->torrentDescription) || empty($this->hashtags)) {
            $this->isFormValid = false;
            return false;
        } else {
            $this->isFormValid = true;
            // Can we assign CSS classes here? To the button id #submitTorrent?

            return true;
        }
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

        // Ask the user to login if they are not already logged-in or the session has expired. Keep hold of the torrent temporarily.
        // @mikerouse - use a modal for this later so session can be renewed or created in the background without losing the torrent context.
        if (!auth()->check()) {
            Log::info('User not logged in. Redirecting to login page.');
            session()->flash('error', 'You must be logged in to submit a torrent.');
            return redirect()->route('login');
        }

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

        $this->isFormValid = true;

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