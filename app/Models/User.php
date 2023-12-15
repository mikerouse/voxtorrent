<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'handle',
        'job_title',
        'bio',
        'hometown',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function owned_torrents()
    {
        return $this->hasMany(Torrent::class, 'owner_id');
    }

    public function torrents_signed()
    {
        return $this->hasMany(TorrentSigners::class);
    }

    public function torrent_teams_joined()
    {
        return $this->belongsToMany(Torrent::class);
    }

    public function decision_maker_teams_joined()
    {
        return $this->belongsToMany(DecisionMakers::class);
    }

    public function constituencies()
    {
        return $this->belongsToMany(Constituency::class);
    }

    public function primary_political_party()
    {
        return $this->belongsTo(PoliticalParty::class);
    }

    public function primary_constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function party_memberships()
    {
        return $this->belongsToMany(PoliticalParty::class);
    }
}

