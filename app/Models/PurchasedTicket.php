<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasedTicket extends Model
{
    /** @use HasFactory<\Database\Factories\PurchasedTicketFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['order_item_id', 'ticket_code', 'is_used'];
    protected $casts = [
        'is_used' => 'boolean',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
