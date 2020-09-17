<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $appends = [
        'name',
        'price',
        'image',
    ];

    protected $fillable = [
        "cart_id",
        "product_id",
        "quantity"
    ];

    protected $visible = [
        "product_id",
        "quantity",
        "name",
        "price",
        "image",
        "product",
    ];

    public function cart(){
        return $this->belongsTo("\App\Models\Cart");
    }

    public function product(){
        return $this->belongsTo("\App\Models\Product");
    }

    public function getNameAttribute(){
        return $this->product->name;
    }

    public function getImageAttribute(){
        return $this->product->image;
    }

    public function getPriceAttribute(){
        return $this->product->price;
    }
}
