<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','price','sale_price','image','category_id','description'];

    public function product(){
        return $this->hasMany(Category::class, 'category_id','id');    
    }
}
