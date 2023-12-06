<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nation',
        'population',
        'incumbent_party',
        'constituency_type_id',
        'ons_id'
    ];

    public function constituency_type()
    {
        return $this->belongsTo(ConstituencyType::class);
    }

    public function decision_makers()
    {
        return $this->belongsToMany(DecisionMakers::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function torrents()
    {
        return $this->belongsToMany(Torrent::class);
    }

}