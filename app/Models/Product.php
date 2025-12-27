<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hpp',
        'margin',
        'price',
    ];

    /**
     * Calculate price automatically based on HPP and Margin.
     * This ensures data consistency before saving.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if ($product->hpp && $product->margin) {
                // Price = HPP + (HPP * Margin / 100)
                $product->price = $product->hpp + ($product->hpp * ($product->margin / 100));
            }
        });
    }
}
