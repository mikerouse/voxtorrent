<?php

namespace App\Models\Legislation;

use App\Models\DecisionMakers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'shortTitle',
        'longTitle',
        'summary',
        'hop_billId',
        'currentHouse',
        'lastUpdate',
        'billWithdrawn',
        'isDefeated',
        'billTypeId',
        'introducedSessionId',
        'includedSessionIds',
        'isAct',
        'currentStage',
    ];

    protected $casts = [
        'includedSessionIds' => 'array',
        'currentStage' => 'array',
    ];

    public function billType()
    {
        return $this->belongsTo(BillType::class, 'billTypeId');
    }

    public function sponsors()
    {
        return $this->belongsToMany(DecisionMakers::class, 'bill_decision_maker'); // Use the pivot table name
    }
}
