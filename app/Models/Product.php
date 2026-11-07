<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'price', 'stock',
    ];

    protected $attributes = ['stock' => 0, 'price' => 0];

    // Relationship Product to Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, foreignKey: 'category_id', ownerKey: 'id');
    }
}
