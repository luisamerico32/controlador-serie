<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    public $timestamps = false;
    protected $fillable = ['number'];

    public function seasons(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
