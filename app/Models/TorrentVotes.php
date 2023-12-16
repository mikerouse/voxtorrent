<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class TorrentVotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'torrent_id',
        'vote',
    ];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!in_array($model->vote, ['like', 'neutral', 'dislike'])) {
                throw new InvalidArgumentException('Invalid vote value');
            }
        });
    }
}