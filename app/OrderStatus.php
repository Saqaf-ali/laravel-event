<?php

namespace App;

enum OrderStatus: int
{
    case Pending = 0;
    case Completed = 1;
    case Cancelled = 2;
    case Failed = 3;
    case Refunded = 4;

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'orange',
            self::Completed => 'green',
            self::Cancelled, self::Failed => 'red',
            self::Refunded => 'blue',
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

    public function getLabel(): string
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
