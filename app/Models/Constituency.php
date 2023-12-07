<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

class Constituency extends Model
{
    use HasFactory;
    use WithPagination;

    public $search = '';

    protected $fillable = [
        'name',
        'nation',
        'population',
        'incumbent_party',
        'constituency_type_id',
        'ons_id', // Office for National Statistics ID for UK Parliamentary Constituency https://geoportal.statistics.gov.uk/datasets/westminster-parliamentary-constituencies-december-2018-uk-bfc
        'hop_id', // House of Parliament ID https://members-api.parliament.uk/swagger/v1/swagger.json
        'current_member_hop_id', // House of Parliament ID of the current member of parliament https://members-api.parliament.uk/swagger/v1/swagger.json
        'mapit_id', // MapIt ID https://mapit.mysociety.org/
        'start_date', // The date the constituency was created
        'end_date', // The date the constituency was abolished
        'is_current', // Is the constituency current?
        'member_count', // The number of members of parliament that now represent the constituency
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