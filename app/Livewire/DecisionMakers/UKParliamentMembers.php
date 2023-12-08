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

class UKParliamentMembers extends Component
{
    use WithPagination;
    public $decisionMakers;
    public $constituencies;
    public $torrents;
    public $users;

    public $decision_maker_id, $title, $first_name, $last_name, $post_nominative_letters, $display_name, $current_party, $gender, $email, $phone, $start_date, $end_date, $is_current, $is_active, $is_suspended, $is_deceased, $is_retired, $thumbnail_url, $hop_id;

    public function render()
    {
        $hoc_members = DecisionMakers::with('constituency')
            ->where('hop_member_id', '!=', null)
            ->orderBy('last_name', 'asc')
            ->paginate(10);

        return view('livewire.decision-makers.hoc-members', ['hoc_members' => $hoc_members])->layout('layouts.app');
    }
}