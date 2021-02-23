<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory,Authenticatable;

    protected $guarded = [];
    protected $hidden = ['user_pass', 'user_activation_key'];


}
