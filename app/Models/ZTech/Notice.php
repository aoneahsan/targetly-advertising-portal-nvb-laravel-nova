<?php

namespace App\Models\ZTech;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class Notice extends Model
{
    use HasFactory, SoftDeletes, Actionable;

    protected $guarded = [];

    protected $casts = [
        'extraAttributes' => 'array',
    ];

    // Relationship methods
    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batchId', 'id');
    }
}
