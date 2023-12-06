<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Constituency;
use App\Models\Torrent;

class TorrentsByConstituency extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight'
    ];

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }
}
