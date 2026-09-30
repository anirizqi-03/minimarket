<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'customer_name',
        'customer_phone',
        'subtotal',
        'discount_percent',
        'discount_amount',
        'tax_amount',
        'other_fee',
        'total',
        'paid',
        'change',
        'payment_method',
        'status',
        'note',
    ];

    protected $casts = [
        'subtotal'          => 'decimal:2',
        'discount_percent'  => 'decimal:2',
        'discount_amount'   => 'decimal:2',
        'tax_amount'        => 'decimal:2',
        'other_fee'         => 'decimal:2',
        'total'             => 'decimal:2',
        'paid'              => 'decimal:2',
        'change'            => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate kode transaksi: TRX-YYYYMMDD-XXX
     */
    public static function generateCode(): string
    {
        $date = now()->format('Ymd');

        $last = self::whereDate('created_at', today())
            ->orderByDesc('id')
            ->first();

        $number = $last ? ((int) substr($last->code, -3)) + 1 : 1;

        return sprintf('TRX-%s-%03d', $date, $number);
    }
}
