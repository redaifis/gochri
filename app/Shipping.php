<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping_methods';

    public function orders(){
        return $this->hasMany('App\Order');
    }
}
