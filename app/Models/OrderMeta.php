<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeta extends Model
{
    use HasFactory;

    protected $table = 'ghabetoo_postmeta';

    public function tracking() {
        $this->belongsTo(Tracking::class, 'order_id', 'post_id');
    }

}
