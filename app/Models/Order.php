<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'folio',
        'customer',
        'discount',
        'total', 
        'tax',
        'closed',
        'user_id',
        'payment_method',
        'canceled_at',
    ];

    protected $dates = [
        'canceled_at',
    ];

    protected $appends = [
        'totalWithTaxes',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Str::padLeft($attributes['folio'], 6, '0'),
        );
    }

    protected function customer(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value),
        );
    }

    protected function discount(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }

    protected function tax(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }

    protected function getTotalWithTaxesAttribute()
    {
        return $this->total + $this->tax;
    }

    public function scopeOnlyClosed($query)
    {
        return $query->where('closed', true);
    }

    /**
     * Get the maximum folio number from the orders table.
     * 
     * This method retrieves the highest folio number currently in use.
     * If no folio numbers exist, returns 0.
     * 
     * @return int The maximum folio number or 0 if no records exist
     */
    public static function getFolio(): int
    {
        return (int) self::withTrashed()->max('folio') ?? 0;
    }

    /**
     * Gets the next available folio number.
     * 
     * This method calculates and returns the next sequential folio number
     * by incrementing the current folio value by one.
     *
     * @return int The next available folio number
     */
    public static function getNextFolio(): int
    {
        return self::getFolio() + 1;
    }
}
