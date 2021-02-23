<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    protected $table = 'ghabetoo_carriers';
    protected $guarded = [];


    public function tracking() {
        return $this->hasMany(Tracking::class, 'carrier_id', 'id');
    }
}
