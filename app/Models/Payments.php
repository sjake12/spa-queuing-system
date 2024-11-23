<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payments extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentsFactory> */
    use HasFactory;

    protected $guarded = [];

    public function paymentStatus(): HasMany
    {
        return $this->hasMany(PaymentStatus::class,'payments_id');
    }

    public function signingOffice(): BelongsTo
    {
        return $this->belongsTo(SigningOffice::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($payment) {
            $students = \App\Models\Student::all();

            $paymentStatus = $students->map(function ($student) {
                return [
                    'student_id' => $student->student_id,
                    'is_paid' => (bool) random_int(0, 1),
                ];
            })->toArray();

            $payment->paymentStatus()->createMany($paymentStatus);
        });
    }
}
