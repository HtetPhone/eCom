<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'd_price', 'in_stock', 'img'];

    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }

    public function cart() : HasOne
    {
        return $this->hasOne(Cart::class, 'product_id');
    }

}
