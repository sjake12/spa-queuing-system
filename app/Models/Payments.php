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

    public static function registerRequirement(): void
    {
        $paymentStatuses = PaymentStatus::where('is_paid', false)->get();

        foreach ($paymentStatuses as $paymentStatus){
            Requirement::firstOrCreate([
                'office_id' => $paymentStatus->payments->office_id,
                'requirement_name' => $paymentStatus->payments->for,
                'requirement_type' => $paymentStatus->payments->payment_type,
                'amount' =>  floatval($paymentStatus->payments->amount),
            ]);
        }
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
