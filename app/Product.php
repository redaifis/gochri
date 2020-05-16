<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory');
    }

    public function images(){
        return $this->hasMany('App\Image')->withPivot('quantity')->withTimestamps();;
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }

}
