<?php

namespace App\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class UKParliamentMembersHOC extends Component
{
    public $members;

    public function mount()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://members-api.parliament.uk/api/Members/All');
        $data = json_decode($response->getBody()->getContents(), true);
        $this->members = $data['value'];
    }

    public function getConstituencyByName($name)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://members-api.parliament.uk/api/Constituencies/ByName/' . $name);
        $data = json_decode($response->getBody()->getContents(), true);
        return $data['value'];
    }

    public function render()
    {
        return view('livewire.ukhoc-members')->layout('layouts.app');
    }
}
