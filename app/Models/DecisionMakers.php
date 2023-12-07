<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Constituency;

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
        'hop_id',
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
}
