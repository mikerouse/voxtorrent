<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberOfParliament extends DecisionMakers
{
    use HasFactory;

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function previous_constituencies()
    {
        return $this->belongsToMany(Constituency::class);
    }
}
