<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DecisionMakers;
use Illuminate\Foundation\Auth\User;

class Torrent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'qr_code',
        'info_hash',
        'owner_id',
        'weight',
        'views',
        'likes',
        'shares',
        'dislikes',
        'flags',
        'is_blocked',
        'is_sensitive',
        'is_trash',
        'is_featured',
        'avg_dwell_time_secs'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function decisionMakers()
    {
        return $this->belongsToMany(DecisionMakers::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
