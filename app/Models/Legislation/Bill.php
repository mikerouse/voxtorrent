<?php

namespace App\Models\Legislation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'shortTitle',
        'longTitle',
        'hop_billId',
        'currentHouse',
        'lastUpdate',
        'billWithdrawn',
        'isDefeated',
        'billTypeId',
        'introducedSessionId',
        'includedSessionIds' => [],
        'isAct',
        'currentStage' => [
            'id',
            'stageId',
            'sessionId',
            'description',
            'abbreviation',
            'house',
            'stageSittings' => [],
            'sortOrder'
        ],
    ];

    protected $casts = [
        'includedSessionIds' => 'array',
        'currentStage' => 'array',
        'hop_billId' => 'integer',
        'billTypeId' => 'integer',
        'introducedSessionId' => 'integer',
        'isAct' => 'boolean',
        'billWithdrawn' => 'boolean',
        'isDefeated' => 'boolean',
        'lastUpdate' => 'datetime',
    ];

    public function billType()
    {
        return $this->belongsTo(BillType::class);
    }
}
