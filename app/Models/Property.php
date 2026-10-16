<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'slug', 'title', 'location', 'price', 'type', 'bedrooms', 'bathrooms', 'area_sq_ft', 'land_sq_ft',
    'status', 'hero_image', 'gallery', 'description', 'features', 'agent', 'is_published',
])]
class Property extends Model
{
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'gallery' => 'array',
            'features' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(PropertyInquiry::class);
    }

    public function toPresentationArray(): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'location' => $this->location,
            'price' => '$'.number_format($this->price),
            'price_value' => $this->price,
            'type' => $this->type,
            'beds' => $this->bedrooms,
            'baths' => $this->bathrooms,
            'area' => number_format($this->area_sq_ft),
            'land' => $this->land_sq_ft ? number_format($this->land_sq_ft) : '—',
            'status' => $this->status,
            'image' => $this->hero_image,
            'gallery' => $this->gallery ?: [$this->hero_image],
            'description' => $this->description,
            'features' => $this->features ?: [],
            'agent' => $this->agent,
        ];
    }
}
