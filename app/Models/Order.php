<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'ghabetoo_posts';
    protected $guarded = [];


    public function ordermeta()
    {
        return $this->hasMany(OrderMeta::class, 'post_id', 'ID');
    }

    public function tracking() {
        return $this->hasOne(Tracking::class, 'order_id', 'ID');
    }
}
