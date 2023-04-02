<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'details',
        'description',
        'product_code',
        'image',
        'price',
        'quantity'
    ];

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function orders(): BelongsToMany{
        return $this->belongsToMany(Order::class);
    }
}
