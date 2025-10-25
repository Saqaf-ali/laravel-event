<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use SoftDeletes;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password', 'image'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected $appends = ['image_url'];
    /**
     * Get the organizer associated with the user.
     *
     * @return HasOne<Organizer, User>
     */
    public function organizer(): HasOne
    {
        return $this->hasOne(Organizer::class);
    }

    /**
     * Get the attendee associated with the user.
     *
     * @return HasOne<Attendee, User>
     */
    public function attendee(): HasOne
    {
        return $this->hasOne(Attendee::class);
    }
    public function imageUrl(): Attribute
    {
        return Attribute::make(get: fn() => Storage::url($this->image));
    }
}
