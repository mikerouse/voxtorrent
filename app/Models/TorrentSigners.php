<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Torrent;
use Illuminate\Foundation\Auth\User;

class TorrentSigners extends Model
{
    use HasFactory;

    protected $fillable = [
        'torrent_id',
        'signer_id',
        'weight',
        'post_code_at_time',
        'is_anonymous_to_decision_maker',
        'is_anonymous_to_public',
        'is_opted_in_to_contact_about_this_signature',
        'reason_for_signing',
        'digital_certificate',
        'public_key'];

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function signer()
    {
        return $this->belongsTo(User::class);
    }
}
