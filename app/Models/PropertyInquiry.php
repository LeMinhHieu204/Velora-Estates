<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'property_id', 'name', 'email', 'phone', 'inquiry_type', 'preferred_location', 'preferred_date',
    'preferred_time', 'message', 'status', 'consented_at',
])]
class PropertyInquiry extends Model
{
    protected function casts(): array
    {
        return ['preferred_date' => 'date', 'consented_at' => 'datetime'];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
