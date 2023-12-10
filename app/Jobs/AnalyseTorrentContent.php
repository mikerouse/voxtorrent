<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AnalyseTorrentContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $component;
    protected $torrentName;
    protected $AiDescriptionId;

    /**
     * Create a new job instance.
     */
    public function __construct(Component $component, $torrentName, $AiDescriptionId)
    {
        $this->component = $component;
        $this->torrentName = $torrentName;
        $this->AiDescriptionId = $AiDescriptionId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Starting job to analyse the torrent content.');
        // API request logic here
        $prompt = "Here is the content of a social media post on my political activism platform: {$this->torrentName}.";
        Log::info('OpenAI API prompt:', [$prompt]);

        $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_SECRET_KEY'),
        'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'Based on the content of the social media post, write a more formal summary suitable to send to an official decision maker, using courteous language.'
            ],
            [
                'role' => 'user',
                'content' => 'Remember, the software is preparing an email on behalf of the user to a decision maker about: ' . $prompt
            ],
        ],
        ])->json();

        // Log the response
        Log::info('OpenAI API response:', $response);

        // Store the response in the cache with a unique key
        $key = 'description_for_' . $this->AiDescriptionId;
        Cache::put($key, $response['choices'][0]['message']['content'], 3600); // Store for 1 hour
        Log::info('Stored response in cache with key: ' . $key);

        // Update the Livewire component
        $this->component->dispatch('descriptionUpdated', [
            'id' => $this->AiDescriptionId,
            'description' => $response['choices'][0]['message']['content']
        ]);

        Log::info('Updated Livewire component with description. Ending job.');
    }
}
