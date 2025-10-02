<?php

namespace App\Models;

use App\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['event_id', 'attendee_id', 'total_price', 'status'];
    protected $casts = [
        'total_price' => 'decimal:2',
        'status' => OrderStatus::class,
    ];

    protected $appends = ['statusLabel', 'statusColor'];
    public function getStatusLabelAttribute()
    {
        return $this->status->statusLabel();
    }

    public function getStatusColorAttribute()
    {
        return $this->status->statusColor();
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }
}
