<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    public $timestamps = false;
    protected $fillable = ['number'];

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function getEpisodesWatched(): Collection
    {
        return $this->episodes->filter(function (Episode $episode) {
            return $episode->watched;
        });
    }
}
