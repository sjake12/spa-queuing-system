<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $primaryKey = 'event_id';

    public function eventAttendances(): HasMany
    {
        return $this->hasMany(EventAttendance::class, 'event_id', 'event_id');
    }

    public static function processUnattendedEvents(): void
    {
        // Get all events that have passed
        $pastEvents = self::where('event_date', '<', now())->where('required', true)->get();

        foreach ($pastEvents as $event) {
            self::processEventAttendance($event);
        }
    }

    private static function processEventAttendance($event): void
    {
        // Get unattended records
        $unattendedRecords = EventAttendance::where('event_id', $event->event_id)
            ->where('attended', false)
            ->get();

        foreach ($unattendedRecords as $record) {
            self::createFinePayment($record);
        }
    }

    private static function createFinePayment($attendance): void
    {
        $finesPerOffice = [
            'PSITS' => '25',
            'CCSO' => '50',
            'SBO' => '75',
        ];
        $signingOfficeId = $attendance->event->signing_office;
        // Create fine payment
        Payments::firstOrCreate([
            'amount' => $finesPerOffice[SigningOffice::where('office_id', $signingOfficeId)->first()->office_name],
            'for' => $attendance->event->event_name,
            'office_id' => $signingOfficeId,
            'deadline' => null,
            'payment_type' => 'fine',
        ]);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($event) {
            $students = \App\Models\Student::all();

            $attendances = $students->map(function ($student) use ($event) {
                return [
                    'event_id' => $event->event_id,
                    'student_id' => $student->student_id,
                    'attended' => (bool)random_int(0, 1),
                ];
            })->toArray();

            $event->eventAttendances()->createMany($attendances);
        });
    }
}
