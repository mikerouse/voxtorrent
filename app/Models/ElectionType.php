<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // e.g. "General Election"
        'description', // e.g. "A general election is an election in which all or most members of a given political body are chosen."
        'slug', // e.g. "general-election"
        'is_active', // can this election be seen by all users?
        'is_locked', // has this election been locked to stop it being edited?
        'is_archived', // has this election been archived?
        'is_trash', // has this election been trashed?
        'created_by', // who created this election?
        'last_updated_by', // who last updated this election?
        'trashed_by',  // who trashed this election?
    ];

    public function elections()
    {
        return $this->hasMany(Election::class);
    }
}
