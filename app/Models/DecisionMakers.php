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
        'email',
        'phone',
        'start_date',
        'end_date'
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
