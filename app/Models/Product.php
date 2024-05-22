<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $appends = ['favorited'];


    protected $fillable = ['name', 'price','sale_price', 'image', 'category_id', 'description', 'status'];

    // 1-1
    public function cat() {
        return $this->hasOne(Category::class, 'id','category_id');
    }

    // 1-n
    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }

    public function getFavoritedAttribute() {
        $favorited = Favorite::where(['product_id' => $this->id, 'customer_id' => auth('cus')->id()])->first();
        return $favorited ? true : false;
    }


}
