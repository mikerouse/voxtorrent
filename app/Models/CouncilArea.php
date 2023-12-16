<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouncilArea extends Constituency
{
    use HasFactory;

    protected $fillable = [
        'seats',
    ];

    public function council_leader()
    {
        return $this->hasOne(DecisionMakers::class);
    }

    public function chief_executive()
    {
        return $this->hasOne(DecisionMakers::class);
    }
}
