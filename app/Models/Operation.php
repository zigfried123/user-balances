<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    protected $fillable = [
        'sum',
        'type',
        'balance_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function balance(): BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }
}
