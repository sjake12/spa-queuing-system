<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clearance extends Model
{
    /** @use HasFactory<\Database\Factories\ClearanceFactory> */
    use HasFactory;

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function signingOffices(): BelongsToMany
    {
        return $this->belongsToMany(SigningOffice::class);
    }

    public function eventAttendance(): HasMany
    {
        return $this->hasMany(EventAttendance::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payments::class);
    }

}
