<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionMaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function constituencies()
    {
        return $this->belongsToMany(Constituency::class);
    }
}
