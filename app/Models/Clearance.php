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

    protected $guarded = [];
    protected $primaryKey = 'clearance_id';

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($clearance) {
            $clearance->refresh();

            $signingOffices = SigningOffice::all();

            $signingOfficeStatuses = $signingOffices->map(function ($signingOffice) use ($clearance) {
                // Check if there are any unpaid payments for this office and student
                $hasPendingPayments = PaymentStatus::whereHas('payments', function ($query) use ($signingOffice) {
                    $query->where('office_id', $signingOffice->office_id);
                })
                ->where('student_id', $clearance->student_id)
                ->where('is_paid', false)
                ->exists();
                return [
                    'clearance_id' => $clearance->clearance_id,
                    'signing_office_id' => $signingOffice->office_id,
                    'is_pending' => $hasPendingPayments
                ];
            })->toArray();

            $clearance->signingOfficeStatuses()->createMany($signingOfficeStatuses);
        });
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function signingOffices(): BelongsToMany
    {
        return $this->belongsToMany(SigningOffice::class);
    }

    public function signingOfficeStatuses(): HasMany
    {
        return $this->hasMany(ClearanceSigningOfficeStatus::class, 'clearance_id', 'clearance_id');
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
