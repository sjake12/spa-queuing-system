<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    public function eventAttendances(): HasMany
    {
        return $this->hasMany(EventAttendance::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($event) {
            $students = \App\Models\Student::all();

            $attendances = $students->map(function ($student) {
               return ['student_id' => $student->student_id];
            })->toArray();

            $event->eventAttendances()->createMany($attendances);
        });
    }
}
