<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'background'];

    public function getBackgroundUrlAttribute()
    {
        if ($this->background) {
            return Storage::url($this->background);
        }

        return Storage::url('series/sem-imagem.png');
    }

    public function season(): HasMany
    {
        return $this->hasMany(Season::class);
    }
}
