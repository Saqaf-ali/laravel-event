<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventImage extends Model
{
    protected $fillable = ['event_id', 'url'];
    protected $hidden = [];

    /** @use HasFactory<\Database\Factories\EventImageFactory> */
    use HasFactory;
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
