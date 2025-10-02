<?php

namespace App;

enum OrderStatus: int
{
    case Pending = 0;
    case Completed = 1;
    case Cancelled = 2;
    case Failed = 3;
    case Refunded = 4;

    public function statusColor(): string
    {
        return match ($this) {
            self::Pending => 'text-orange-500',
            self::Completed => 'text-primary',
            self::Cancelled, self::Failed => 'text-destructive',
            self::Refunded => 'text-blue-500',
        };
    }

    public static function fromInt(int $status): self
    {
        return match ($status) {
            0 => self::Pending,
            1 => self::Completed,
            2 => self::Cancelled,
            3 => self::Failed,
            default => throw new \InvalidArgumentException("Invalid order status: $status"),
        };
    }

    public function statusLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
            self::Failed => 'Failed',
            self::Refunded => 'Refunded',
        };
    }
}
