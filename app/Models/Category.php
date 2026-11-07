<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    // Relationship Category to Products
    public function products(): HasMany
    {
        return $this->HasMany(Product::class, foreignKey: 'category_id', localKey: 'id');
    }
}
