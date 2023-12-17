<?php

namespace App\Models\Geography;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use App\Models\DecisionMakers;
use App\Models\Constituency;
use App\Models\Hashtag;
use App\Models\Mayor;
use App\Models\CombinedAuthority;
use App\Models\CouncilArea;
use App\Models\Torrent;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // example "London"
        "lat", // "51.5072", 
        "lng", // "-0.1275", 
        "country", // "United Kingdom", 
        "iso2", // "GB", 
        "admin_name", // "London, City of", 
        "capital", // "primary", 
        "population", // "11262000", 
        "population_proper", // "8825001"
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }

    public function decisionMakers()
    {
        return $this->hasMany(DecisionMakers::class);
    }

    public function hashtags()
    {
        return $this->hasMany(Hashtag::class);
    }

    public function mayors()
    {
        return $this->hasMany(Mayor::class);
    }

    public function combined_authorities()
    {
        return $this->hasMany(CombinedAuthority::class);
    }

    public function councils()
    {
        return $this->hasMany(CouncilArea::class);
    }
}
