<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    const
        CURRENCY_ILS = 'ILS',
        CURRENCY_EUR = 'EUR',
        CURRENCY_USD = 'USD';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sale_number',
        'description',
        'amount',
        'currency',
        'payment_link',
    ];

    /**
     * Get available currencies
     *
     * @return array
     */
    public static function getCurrencies(): array
    {
        return [
            self::CURRENCY_ILS,
            self::CURRENCY_EUR,
            self::CURRENCY_USD,
        ];
    }
}
