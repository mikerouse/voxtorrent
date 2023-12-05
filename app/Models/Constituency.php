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
    ];

    public function type()
    {
        return $this->belongsTo(ConstituencyType::class);
    }

    public function decisionMakers()
    {
        return $this->belongsToMany(DecisionMaker::class);
    }
}
