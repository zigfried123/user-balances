<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    const TYPE = [
        'DEBIT' => 'debit',
        'CREDIT' => 'credit',
    ];

    protected $fillable = [
        'sum',
        'type',
        'balance_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d h:i:s',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function balance(): BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }
}
