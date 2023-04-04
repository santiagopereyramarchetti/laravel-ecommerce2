<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'slug',
        'details',
        'description',
        'product_code',
        'main_image',
        'alt_images',
        'price',
        'quantity'
    ];

    protected $casts = [
        'alt_images' => 'array',
    ];

    public function searchableAs(): string
    {
        return 'products';
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'details' => $this->details,
            'description' => $this->description,
            'product_code' => $this->product_code,
            'main_image' => $this->main_image,
            'alt_images' => $this->alt_images,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'categories' => $this->categories->pluck('name')->toArray(),
        ];
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function orders(): BelongsToMany{
        return $this->belongsToMany(Order::class);
    }
}
