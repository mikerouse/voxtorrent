<?php

namespace App\Livewire\Torrents;

use Livewire\Component;
use App\Models\Torrent;
use App\Models\TorrentSigners;
use App\Models\User;
use App\Models\PoliticalParty;
use Livewire\WithPagination;

/**
 * The permalink component is responsible for displaying a single torrent.
 * 
 */
class Permalink extends Component
{
    use WithPagination;
    public $torrent;
    public $currentPage = 1;
    public $itemsPerPage = 25;
    public $signatures = [];
    public $signaturesByParty = [];
    public $backgroundColors = ['red', 'blue', 'green', 'yellow']; // Replace with your actual colors
    public $borderColors = ['darkred', 'darkblue', 'darkgreen', 'darkyellow']; // Replace with your actual colors

    public function mount($torrentId)
    {
        $this->torrent = Torrent::find($torrentId);
        $this->loadSignatures();

        $this->signaturesByParty = TorrentSigners::with('signer.primary_political_party')
            ->get()
            ->groupBy('signer.primary_political_party.abbreviation')
            ->map->count();

        // Convert to array if it's a collection
        $this->signaturesByParty = $this->signaturesByParty->toArray();
        // Sort the array by 'abbreviation' alphabetically
        ksort($this->signaturesByParty);

        // the background and border colors can be the same.
        // the colors are held as a value called brand_color_hex within the primary_political_party object.
        // create an array from the signaturesByParty array, and then map the brand_color_hex value to the background and border colors arrays.
        // first, we need to get the brand_color_hex values and the party name from the parties table in the db.

        $allParties = PoliticalParty::all()->sortBy('abbreviation');
        $colorsMap = array_map(function ($party) {
            return [
                'name' => $party['abbreviation'],
                'brand_color_hex' => $party['brand_color_hex'] ?? '#333333',
            ];
        }, $allParties->toArray());
    
        // now we need to ensure the $colorsMap array is in the same order as the $signaturesByParty array.
        // we can do this by sorting the $colorsMap array by the party name.
        // then we can map the brand_color_hex value to the background and border colors arrays.
        // then we can use the background and border colors arrays in the chart.

        array_multisort(array_column($colorsMap, 'name'), SORT_ASC, $colorsMap);

        $this->backgroundColors = array_map(function ($party) {
            return $party['brand_color_hex'];
        }, $colorsMap);
            
    }

    public function loadSignatures()
    {
        $this->signatures = TorrentSigners::with('signer.primary_political_party')
            ->skip(($this->currentPage - 1) * $this->itemsPerPage)
            ->take($this->itemsPerPage)
            ->get()
            ->toArray();
    }

    public function goToPage($page)
    {
        $this->currentPage = $page;
        $this->loadSignatures();
    }

    public function render()
    {
        return view('livewire.torrents.permalink', ['torrent' => $this->torrent, 'signatures' => $this->signatures])->layout('layouts.app');
    }
}
