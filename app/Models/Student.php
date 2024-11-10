<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'student_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($student) {
            User::create([
                'username' => $student->student_id,
                'password' => bcrypt('1234'),
            ]);
        });
    }

    public function user()
    {
        return $this->hasOne(User::class, 'username', 'student_id');
    }
}
