<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function album()
    {
        return $this->hasMany(Image::class);
    }

    public function variations()
    {
        return $this->hasMany(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
