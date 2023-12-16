<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstituencyType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'acronym'];

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }

    public function decision_makers()
    {
        return $this->hasMany(DecisionMakers::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }

    public function hashtags()
    {
        return $this->hasMany(Hashtag::class);
    }
}
