<?php

namespace App\Models\Cupons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'cuponable_id',
        'cuponable_type'
    ];

    public function cuponable(){
        return $this->morphTo();
    }

    public static function findByCode($code){
        return self::where('code',$code)->first();
    }

    public function discount($order){
        return $this->cuponable()->discount($order);
    }
}
