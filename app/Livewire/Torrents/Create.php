<?php

namespace App\Livewire\Torrents;

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
use Illuminate\Support\Facades\Validator;
use Livewire\Form;
use App\Insert\HashtagInsert;
use WireElements\Pro\Icons\Hashtag;
use App\Models\Hashtag as ModelsHashtag;

class Create extends Component
{
    /**
     * Mount and render methods 
     */
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
        $this->issueType = '';
        $this->showTitleAndDescription = false;
    }

    public function render()
    {
        return view('livewire.torrents.create')->layout('layouts.app');
    }

    /**
     * My listeners
     */
    protected $listeners = [
        'submitForm' => 'handleFormSubmission',
        'updateDescription' => 'updateDescription',
        'createNewHashtag' => 'handleNewHashtag',
        'updateIssueType' => 'setIssueType',
        'decisionMakerSelected' => 'decisionMakerSelected',
        'goToStage' => 'goToStage',
    ];

    /**
     * My properties
     */
    public $pageTitle = 'Choose the type of issue you want to raise'; 
    public $pageSubtitle = '';
    public $stage = 1;
    // An array to hold the decision makers who will be the recipients of the torrent
    #[Validate('required')]
    public $selectedDecisionMakers = [];
    #[Validate('required')]
    public $hashtags = [];
    public $incomingHashtags = '';
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
    public $showAddMore = false;
    public $issueType;
    public $showTitleAndDescription = false;

    /**
     * Listener handler methods
     */
    public function goToStage($stage)
    {
        $this->stage = $stage;
        switch($stage) {
            case 1:
                $this->pageTitle = 'Choose the type of issue you want to raise';
                $this->pageSubtitle = '';
                break;
            case 2:
                $this->pageTitle = 'Choose the decision makers';
                $this->pageSubtitle = 'Select the decision makers who can help.';
                break;
            case 3:
                $this->pageTitle = 'Describe the issue';
                $this->pageSubtitle = 'Describe the issue you want to raise. You can use the AI to help you write the description.';
                break;
            case 4:
                $this->pageTitle = 'Review and submit';
                $this->pageSubtitle = 'Review your issue before submitting it.';
                break;
            default:
                $this->pageTitle = 'Choose the type of issue you want to raise';
                $this->pageSubtitle = '';
                break;
        }
        $this->render();
    }

    /**
     * My methods
     */
    public function handleNewHashtag($query)
    {
        // Check that the query is a string - it should be - and make sure it is a string
        if (!is_string($query)) {
            Log::info('Query is not a string: ' . $query);
            return;
        }

        // Now we need to check that the hashtag does not already exist in the database
        // If it does already exist by 'name' then return early
        if (ModelsHashtag::where('name', $query)->exists()) {
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
        $newHashtag = ModelsHashtag::create(
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

    public function updated()
    {
        Log::info('Component Updated', ['torrentDescription' => $this->torrentDescription]);
    }

    /**
     * @param string $type
     * @return void
     * This method is called when a decision maker is selected from the search results
     */
    public function decisionMakerSelected($id)
    {
        $decisionMaker = DecisionMakers::find($id);

        if (!is_array($this->selectedDecisionMakers)) {
            $this->selectedDecisionMakers = [];
        }

        if (!array_key_exists($decisionMaker->id, $this->selectedDecisionMakers)) {
            $this->selectedDecisionMakers[$decisionMaker->id] = $decisionMaker;
        }

        // $this->dispatch('decisionMakerSelected', $decisionMaker->id);
        $this->showAddMore = false;
    }

    public function showDecisionMakerChooser()
    {
        $this->showAddMore = true;
        // $this->dispatch('showDecisionMakerChooser');
    }

    public function switchIssueType($newIssueType)
    {
        $this->issueType = "";
        $this->pageTitle = "Choose the type of issue you want to raise";
        $this->pageSubtitle = "";
        $this->dispatch('issueTypeChanged', $newIssueType);
    }

    public function updateDescription($htmlContent)
    {
        $this->torrentDescription = $htmlContent;
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
            $this->stage = 2;
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
        dd($data);
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

    /** 
     * Event handlers
     */

     /**
      * @param string $type
      * @return void
      */
    public function setIssueType($type)
    {
        $this->issueType = $type;
        switch($type)
        {
            case 'casework':
                $this->pageTitle = 'Create a new casework issue';
                $this->pageSubtitle = 'Casework issues are for when you need help with a personal issue, such as a problem with your benefits, or a problem with a government department.';
                break;
            case 'bill':
                $this->pageTitle = 'Create a new bill';
                break;
            case 'petition':
                $this->pageTitle = 'Create a new petition';
                $this->pageSubtitle = 'Petitions are for when you want to raise awareness of an issue, or to get people to sign a petition.';
                break;
            case 'campaign':
                $this->pageTitle = 'Create a new campaign';
                break;
            case 'policy':
                $this->pageTitle = 'Create a new policy';
                break;
            case 'question':
                $this->pageTitle = 'Create a new question';
                break;
            case 'idea':
                $this->pageTitle = 'Create a new idea';
                break;
            case 'other':
                $this->pageTitle = 'Create a new issue';
                break;
            default:
                $this->pageTitle = 'Create a new issue';
                break;
        }
        $this->stage = 2;
        $this->goToStage(2);
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

        $formDetails = [
            'selectedDecisionMakers' => $this->selectedDecisionMakers, 
            'torrentDescription' => $this->torrentDescription, 
            'hashtags' => $this->hashtags, 
            'issueType' => $this->issueType
        ];
        Log::info('Form details: ' . json_encode($formDetails));

        dd($formDetails);

        if (empty($this->issueType))
        {
            // We need to know what type of issue this is, so we can route it to the correct decision makers and handle the content appropriately
            Log::error('No issue type selected', ['user' => auth()->user()->id()]);
            $this->dispatch('noIssueType');
            return;
        }

        if (empty($this->torrentDescription)) {
            // We need a torrent content
            $this->dispatch('noDescription');
        }
        Log::info('Submitting torrent. Decision Makers: ' . json_encode($this->selectedDecisionMakers) . ', Torrent Description: ' . json_encode($this->torrentDescription) . ', Hashtags: ' . json_encode($this->hashtags));

        if ($this->torrentName === null)
        {
            $this->generateTorrentName();
        }

        // Validation
        $this->validate(
            [
                'selectedDecisionMakers' => 'required',
                'hashtags' => 'required',
                'torrentDescription' => 'required',
                'torrentName' => 'required',
            ]
        );

        $this->isFormValid = true;
        

        // Store the torrent
        $created_torrent = Torrent::create(
            [
                'name' => $this->torrentName,
                'description' => $this->torrentDescription,
                'decision_makers' => json_encode($this->selectedDecisionMakers),
                'hashtags' => json_encode($this->hashtags),
                'slug' => Str::slug($this->torrentName),
                'type' => $this->issueType,
                'owner_id' => auth()->user()->id,
            ]
        );

        Log::info('Torrent created: ' . $this->torrentName);

        // Dispatach an event to the browser to update the UI
        $this->dispatch('torrent-created', id: $created_torrent->id);

        // Redirect to the /latest route
        return redirect()->route('latest');
    }
}