<?php

namespace App\Models;

use App\Classes\Jalali;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'ghabetoo_trackings';
    protected $guarded = [];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'ID');
    }

    public function ordermeta() {
        return $this->hasMany(OrderMeta::class, 'post_id', 'order_id');
    }

    public function carrier() {
        return $this->hasOne(Carrier::class, 'id', 'carrier_id');
    }

    public function getShipDateAttribute($value)
    {
        return Jalali::jdate("l j F ساعت G:i" ,strtotime($value), '', 'local');
    }

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 'processing':
                return 'در حال انجام';
            case 'delivering':
                return 'ارسال شده و در حال پخش';

        }
    }

    public function scopeOfMeta($query, $key) {

        $hasMeta = $this->ordermeta->pluck('meta_value', 'meta_key')->has($key);
        return $hasMeta ?$this->ordermeta->pluck('meta_value', 'meta_key')[$key]: '-';
    }
}
