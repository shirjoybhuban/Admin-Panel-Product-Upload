<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function seller()
    {
        return $this->belongsTo('App\Model\Seller', 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Model\Brand','brand_id');

    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }
    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id');
    }
    public function publisher()
    {
        return $this->belongsTo('App\Publisher', 'publisher_id');
    }
    public function stocks(){
        return $this->hasMany("App\Model\ProductStock",'product_id');
    }
    public function wishlist()
    {
        return $this->hasMany('App\Model\Wishlist', 'product_id');
    }
    public function productStock() {
        return $this->hasMany('App\Model\ProductStock', 'product_id');
    }

}
