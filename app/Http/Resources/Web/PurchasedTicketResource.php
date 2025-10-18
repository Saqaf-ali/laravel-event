<?php

namespace App\Http\Resources\Web;

use App\Services\QrCodeGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchasedTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ticket_code' => $this->ticket_code,
            'qr_code' => app(QrCodeGeneratorService::class)->generate($this->ticket_code)->getDataUri(),
            'order_item' => new OrderItemResource($this->whenLoaded('orderItem')),
        ];
    }
}
