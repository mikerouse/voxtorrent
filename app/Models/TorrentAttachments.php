<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Torrent;
use Illuminate\Foundation\Auth\User;

class TorrentAttachments extends Model
{
    use HasFactory;

    protected $fillable = [
        'torrent_id',
        'owner_id',
        'name',
        'description',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'file_extension',
        'file_mime_type',
        'file_url',
        'file_hash',
        'file_hash_type',
        'is_encrypted',
        'encryption_key',
        'encryption_key_type',
        'is_blocked',
        'is_sensitive',
        'is_trash',
        'flags',
        'weight',
        'downloads',
        'views',
        'likes',
        'shares',
        'dislikes'];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
