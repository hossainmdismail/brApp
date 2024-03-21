<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'campaign_products', 'campaign_id', 'product_id');
    }
}
