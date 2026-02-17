<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone', 'customer_city',
        'customer_address', 'notes', 'total', 'status', 'whatsapp_sent',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'whatsapp_sent' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        $last = static::max('id') ?? 0;
        return 'ORD-' . str_pad($last + 1, 4, '0', STR_PAD_LEFT);
    }
}
