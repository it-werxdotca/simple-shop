<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = [
        "rating"
    ];

    protected $visible = [
        "id",
        "name",
        "status",
        "slug",
        "discount",
        "price",
        "pictures",
        "discountPrice",
        "image",
        "freeShipping",
        "rating",
        "description",
        "category",
        "reviews",
    ];

    //protected

    public function getRatingAttribute(){
        return $this->reviewData()["average"];
    }

    public function pictures(){
        return $this->hasMany("\App\Models\ProductPicture");
    }

    public function reviews(){
        return $this->hasMany("\App\Models\ProductReview");
    }

    public function category(){
        return $this->belongsToMany("\App\Models\Category","product_categories");
    }

    public function reviewData(){
        $data = [
            "average" => $this->reviews()->avg("rating"),
        ];
        for($i=1;$i<6;$i++){
            $data[$i] = [
                "count" => $this->reviews()->where("rating",$i)->count(),
                "percent" => ($this->reviews()->where("rating",$i)->count()
                        / $this->reviews()->count()) * 100
            ];
        }

        return $data;
    }

    public function description(){
        return $this->hasOne("\App\Models\ProductDescription");
    }

    public function orders(){
        return $this->hasManyThrough("\App\Models\Order","\App\Models\OrderItem");
    }
}
