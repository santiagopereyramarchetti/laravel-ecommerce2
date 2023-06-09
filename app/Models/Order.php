<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'confirmation_number',
        'billing_email',
        'billing_name',
        'billing_name_on_card',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_zip_code',
        'billing_discount',
        'billing_discount_code',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'shipped',
    ];

    protected $casts = [
        'created_at' => 'datetime:F j, Y',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany{
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

}
