<?php

namespace App\Models\Cupons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedValueCupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    public function discount($order){
        return $this->value;
    }
}
