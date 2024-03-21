<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'price',
        'qnt',
    ];


    function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    function images()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

    function services()
    {
        return $this->hasMany(ProductService::class, 'product_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_products', 'product_id', 'campaign_id');
    }

    public function getFinalPriceAttribute()
    {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function stockItem()
    {
        return $this->hasMany(ProductQuantity::class, 'product_id');
    }

    public function stock()
    {
        // Sum the 'qnt' values from the related 'ProductQuantity' records
        return $this->stockItem()->sum('quantity');
    }
}
