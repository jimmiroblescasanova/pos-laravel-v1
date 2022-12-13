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
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function customer(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value),
        );
    }

    public function scopeSearch($query, $search)
    {
        $search = "%$search%";
    }
}
