<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['order_id', 'ticket_id', 'quantity', 'event_id', 'line_total'];
    protected $casts = [
        'line_total' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function purchasedTickets()
    {
        return $this->hasMany(PurchasedTicket::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
