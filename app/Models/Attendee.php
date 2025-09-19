<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends Model
{
    /** @use HasFactory<\Database\Factories\AttendeeFactory> */
    use HasFactory;
    protected $fillable = ['user_id'];
    protected $hidden = [];

    /**
     *  Get the users associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Attendee>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
