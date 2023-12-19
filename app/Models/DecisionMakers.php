<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Constituency;
use App\Models\Legislation\Bill;

class DecisionMakers extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'post_nominative_letters',
        'display_name',
        'current_party',
        'gender',
        'email',
        'phone',
        'start_date',
        'end_date',
        'is_current',
        'is_active',
        'is_suspended',
        'is_deceased',
        'is_retired',
        'thumbnail_url',
        'hop_member_id',
    ];

    public function constituencies()
    {
        return $this->belongsToMany(Constituency::class);
    }

    public function torrents()
    {
        return $this->belongsToMany(Torrent::class);
    }

    public function team_members()
    {
        return $this->belongsToMany(User::class);
    }

    public function constituency_types()
    {
        return $this->belongsToMany(ConstituencyType::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }
    public function political_parties()
    {
        return $this->belongsToMany(PoliticalParty::class, 'political_party_decision_maker');
    }

    public function bills_sponsoring()
    {
        return $this->belongsToMany(Bill::class, 'bill_decision_maker'); // Use the pivot table name
    }
}
