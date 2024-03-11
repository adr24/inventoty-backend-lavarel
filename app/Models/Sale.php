<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'client',
        'total',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_sales')
            ->withPivot('quantity');
    }
}
