<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Torrent;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;

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

    public function political_party_at_time()
    {
        return $this->belongsTo(PoliticalParty::class);
    }

    public function decision_maker_at_time()
    {
        return $this->belongsTo(DecisionMakers::class);
    }

    public function constituency_at_time()
    {
        return $this->belongsTo(Constituency::class);
    }
}
