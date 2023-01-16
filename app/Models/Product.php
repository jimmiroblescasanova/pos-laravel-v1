<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected function barcode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper(Str::replace(' ', '', $value)),
        );
    }

    protected function supplierCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper(Str::replace(' ', '', $value)),
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value),
        );
    }

    protected function cost(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100,
        );
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeSearch($query, $search)
    {
        $search = "%$search%";

        return $query->where('barcode', 'LIKE', $search)
            ->orWhere('name', 'LIKE', $search)
            ->orWhere('supplier_code', 'LIKE', $search);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_FILL, 80, 80)
                    ->background('FFF')
                    ->nonQueued();

                $this
                    ->addMediaConversion('small')
                    ->fit(Manipulations::FIT_FILL, 150, 150)
                    ->background('FFF')
                    ->nonQueued();
            });
    }
}
