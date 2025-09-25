<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizer extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizerFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'user_id'];

    /**
     *  Get the users associated with the organizer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Organizer>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
