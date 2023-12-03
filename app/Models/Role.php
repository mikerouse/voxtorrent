<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description', 'self_selectable', 'backend_management']; // Added 'backend_management' field

    public function users() {
        return $this->belongsToMany(User::class);
    }
    
}
