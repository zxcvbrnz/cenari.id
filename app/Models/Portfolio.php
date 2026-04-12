<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    protected $fillable = ['title', 'slug', 'category_id', 'author', 'description', 'tech'];

    protected $casts = [
        'tech' => 'array',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(PortfolioCategory::class, 'portfolio_portfolio_category');
    }

    public function featuredImage()
    {
        return $this->hasOne(PortfolioImage::class)->where('is_featured', true);
    }
}
