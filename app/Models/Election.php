<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'polling_day',
        'description',
        'slug',
        'is_active',
        'is_locked',
        'is_archived',
        'is_trash',
        'created_by',
        'last_updated_by',
        'trashed_by',
        'election_type_id',
    ];

    public function electionType()
    {
        return $this->belongsTo(ElectionType::class);
    }
}
