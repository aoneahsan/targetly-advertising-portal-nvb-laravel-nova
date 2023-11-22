<?php

namespace App\Models\Targetly;

use App\Models\Default\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class SocialPostLink extends Model
{
    use HasFactory, SoftDeletes, Actionable;

    protected $guarded = [];

    protected $casts = [
        'lastCheckAt' => 'datetime',
        'nextRecheckAt' => 'datetime',
        'extraAttributes' => 'array',
    ];

     // Relationship methods
     public function user(): BelongsTo 
     {
         return $this->belongsTo(User::class, 'userId', 'id');
     }
     
}
