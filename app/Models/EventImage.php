<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
class EventImage extends Model
{
    protected $fillable = ['event_id', 'url'];
    protected $hidden = [];
    protected $appends = ['image_url'];

    /** @use HasFactory<\Database\Factories\EventImageFactory> */
    use HasFactory;
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(get: fn() => Storage::url($this->url));
    }
}
