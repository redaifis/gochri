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

    public function wishlist(){
        return $this->belongsToMany('App\Wishlist');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Retrieve products with promotion
    public function scopePromotion($query)
    {
        return $query->where('discount','>','0');
    }

    // Retrieve recommanded products
    public function scopeRecommanded($query)
    {
        return $query->where('recommanded', true);
    }

    // Retrieve latest products
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at','desc');
    }

    // Retrieve published products only
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    // Retrieve popular products  desc
    public function scopePopular($query)
    {
        return $query->where('sales', '>', 1)->orWhere('views', '>', 1)->orderBy('views', 'desc');
    }


}
