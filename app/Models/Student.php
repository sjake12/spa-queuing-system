<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'student_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($student) {
            User::create([
                'username' => $student->student_id,
                'password' => bcrypt('1234'),
            ]);
        });
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'username', 'student_id');
    }

    public function clearance(): HasOne
    {
        return $this->hasOne(Clearance::class, 'student_id', 'student_id');
    }
}
