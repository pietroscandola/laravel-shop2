<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'brand_id'
    ];
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }
}
