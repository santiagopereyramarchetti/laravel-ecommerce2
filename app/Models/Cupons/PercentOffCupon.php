<?php

namespace App\Models\Cupons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentOffCupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'percent_off',
    ];

    public function discount($order){
        return round(($this->percent_off / 100) * $order);
    }
}
