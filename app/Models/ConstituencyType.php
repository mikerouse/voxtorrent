<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstituencyType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'acronym'];

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }
}
