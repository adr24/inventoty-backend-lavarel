<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'stock',
        'category_id',
        'price',
        'image',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

}
