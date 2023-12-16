<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'is_active',
        'is_locked',
        'is_archived',
        'is_trash',
        'created_by',
        'last_updated_by',
        'trashed_by',
    ];

    public function elections()
    {
        return $this->hasMany(Election::class);
    }
}
