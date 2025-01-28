<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['ad_url', 'email', 'confirmed', 'last_price', 'token'];
}
