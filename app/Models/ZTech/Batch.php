<?php

namespace App\Models\ZTech;

use App\Models\Default\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class Batch extends Model
{
    use HasFactory, SoftDeletes, Actionable;

    protected $guarded = [];

    protected $casts = [
        'startDate' => 'datetime',
        'endDate' => 'datetime',
        'extraAttributes' => 'array',
    ];

    // Relationship methods
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Student::class, 'batchId', 'userId', 'id', 'id');
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class, 'batchId', 'id');
    }
}