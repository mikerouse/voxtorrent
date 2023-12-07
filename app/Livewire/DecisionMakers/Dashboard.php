<?php

namespace App\Livewire\DecisionMakers;

use Livewire\Component;
use App\Models\DecisionMakers;
use App\Models\Constituency;
use App\Models\ConstituencyType;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\User;
use App\Models\Torrent;

class Dashboard extends Component
{
    use WithPagination;
    public $decisionMakers;
    public $constituencies;
    public $torrents;
    public $users;

    public $decision_maker_id, $title, $first_name, $last_name, $post_nominative_letters, $display_name, $current_party, $gender, $email, $phone, $start_date, $end_date, $is_current, $is_active, $is_suspended, $is_deceased, $is_retired, $thumbnail_url, $hop_id;

    public function render()
    {
        return view('livewire.decision-makers.dashboard')->layout('layouts.app');
    }
}