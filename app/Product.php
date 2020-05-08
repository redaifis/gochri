<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function categorie(){
        return $this->belongsTo('App\Categorie');
    }

    public function subcategorie(){
        return $this->belongsTo('App\Subcategorie');
    }

    public function images(){
        return $this->hasMany('App\Image')->withPivot('quantity')->withTimestamps();;
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }

}
