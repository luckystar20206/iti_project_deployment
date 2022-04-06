<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'discount',
        'average_rate',
        'category_id',
        'brand_id',
    ];

    // protected $append = ['is_wished'];

    public function isWished()
    {
        if(auth()->check()){
            return $this->wishedProduct()->whereUserId(auth()->id())->exists();
            }else{
            return false;
            }
    }
    public function isBought()
    {
        if(auth()->check()){
            return $this->orderedProduct()->whereUserId(auth()->id())->exists();
            }else{
            return false;
            }
    }
    public function isRated()
    {
        if(auth()->check()){
            return $this->ratedProduct()->whereUserId(auth()->id())->exists();
            }else{
            return false;
            }
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function wishedProduct()
    {
    return $this->belongsToMany(User::class,UserProduct::class);
    }
    public function orderedProduct()
    {
    return $this->belongsToMany(Order::class,OrderProduct::class);
    }
    public function ratedProduct()
    {
    return $this->belongsToMany(User::class,Review::class);
    }


    public function orders(){
        return $this->belongsToMany(Order::class, 'order_products');
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class);
    }
}
