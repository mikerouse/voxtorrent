<?php

namespace App\Models\Legislation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    use HasFactory;

    protected $fillable = ['hop_id', 'name', 'category', 'description'];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
