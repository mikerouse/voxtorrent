<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
        'slug',
        'description',
        'wikpedia_url',
        'logo_url',
        'is_blocked',
        'is_trash',
        'is_featured',
        'brand_color_hex',
        'brand_color_rgb',
        'brand_color_rgba',
    ];

    public function editors()
    {
        return $this->belongsToMany(User::class);
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }

    public function constituencies_held()
    {
        return $this->belongsToMany(Constituency::class);
    }

    public function decisionMakers()
    {
        return $this->belongsToMany(DecisionMakers::class);
    }

    public function leader()
    {
        return $this->hasOne(DecisionMakers::class);
    }

    public function candidates()
    {
        return $this->hasMany(DecisionMakers::class);
    }

    public function officials()
    {
        return $this->hasMany(DecisionMakers::class);
    }

    public function voters()
    {
        return $this->hasMany(User::class);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtags::class);
    }
}
