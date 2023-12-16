<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Councillor extends DecisionMakers
{
    use HasFactory;

    public function councils()
    {
        return $this->belongsToMany(CouncilArea::class);
    }

    public function predecessor()
    {
        return $this->belongsTo(Councillor::class);
    }

    public function successor()
    {
        return $this->hasOne(Councillor::class);
    }
}
