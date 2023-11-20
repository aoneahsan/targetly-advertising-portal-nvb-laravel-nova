<?php

namespace App\Models\ZTech;

use App\Models\Default\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function students(): HasManyThrough
    {
        // return $this->hasManyThrough(User::class, Student::class, 'batchId', 'id', 'id', 'userId');
        return $this->hasManyThrough(User::class, Student::class, 'batchId', 'userId', 'id', 'id');
    }
}

// users
//     id - integer
//     name - string
 
// batch
//     id - integer
//     name - string
 
// students
//     user_id - integer
//     batch_id - integer


// users
//     id - integer
//     name - string
 
// roles
//     id - integer
//     name - string
 
// role_user
//     user_id - integer
//     role_id - integer