<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'total', 
        'closed',
        'user_id',
        'canceled_at',
    ];

    protected $dates = [
        'canceled_at',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Str::padLeft($attributes['id'], 5, '0'),
        );
    }

    protected function customer(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value),
        );
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }
}
