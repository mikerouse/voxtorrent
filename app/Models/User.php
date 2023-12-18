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
        'email_verified_at',
        'bio',
        'hometown',
        'location',
        'is_verified',
        'is_active',
        'is_protected',
        'is_suspended',
        'is_banned',
        'is_deleted',
        'is_flagged',
        'gender',
        'date_of_birth',
        'phone',
        'thumbnail_url',
        'cover_url',
        'primary_constituency_id',
        'primary_political_party_id',
        'is_decision_maker',
        'is_mayor',
        'is_mp',
        'is_governor',
        'is_senator',
        'is_president',
        'is_vip',
        'is_team_member',
        'is_team_leader',
        'is_team_admin',
        'is_team_owner',
        'is_featured',
        'followers_count',
        'following_count',
        'posts_count',
        'comments_count',
        'likes_count',
        'dislikes_count',
        'shares_count',
        'flags_count',
        'views_count',
        'last_login_at',
        'last_login_ip',
        'last_login_device',
        'last_login_location',
        'last_login_country',
        'last_login_region',
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
        return $this->hasMany(TorrentSigners::class, 'signer_id');
    }

    public function torrent_teams_joined()
    {
        return $this->belongsToMany(Torrent::class);
    }

    public function decision_maker_profile()
    {
        return $this->hasOne(DecisionMakers::class);
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

    public function torrent_voting_history()
    {
        return $this->hasMany(TorrentVotes::class);
    }

    public function activities()
    {
        return $this->hasMany(UserActivityLog::class);
    }
}

