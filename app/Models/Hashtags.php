<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DecisionMakers;
use Illuminate\Foundation\Auth\User;

class Hashtags extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'creator_id',
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
    ];

    /** 
     * 
     * We want hashtags to be ubiquitous across all content types
     * They should be able to be added to any content type
     * Fully polymorphic, so we can add them to any content type
     * Fully searchable, so we can search for them in any content type
     * A fully taggable system, so we can tag them in any content type
     * 
     */

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function decisionMakers()
    {
        return $this->belongsToMany(DecisionMakers::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function signatures()
    {
        return $this->hasMany(TorrentSigners::class);
    }

    public function constituencies()
    {
        return $this->belongsToMany(Constituency::class);
    }

    public function torrents()
    {
        return $this->belongsToMany(Torrent::class);
    }
}